<?php

namespace My\FrontendBundle\Controller;


use My\DataSourceBundle\Entity\Resume;
use My\DataSourceBundle\Utilities\ProfileHelper;
use My\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends BaseController
{
    private function createResumeFromUserObject(User $user) {
        $entity = new Resume();
        $entity->setEmail($user->getEmail());
        $entity->setUserId($user->getId());
        $entity->setFirstName($user->getUsername());
        $entity->setLastName($user->getUsername());

        $em = $this->getDoctrine()->getManager();

        $em->persist($entity);
        $em->flush();
        return $entity;
    }
    public function editAction(Request $request)
    {

        if( ! $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') ) {
            // authenticated (NON anonymous)
            return $this->redirect($this->generateUrl('my_frontend_homepage'));
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (! $user) {
            return $this->redirect($this->generateUrl('my_frontend_homepage'));
        }

        $entity = $this->getDoctrine()
            ->getRepository('MyDataSourceBundle:Resume')
            ->findOneBy(array('user_id' => $user->getId()));
        if (empty($entity)) {
            //not found so creating a resume
            $entity = $this->createResumeFromUserObject($user);
        }

        return $this->render('@MyFrontend/User/edit.html.twig',
                    array('entity' => $entity,
                ));
    }

    public function updateAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if (empty($user)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyDataSourceBundle:Resume')
                ->findOneBy(array('user_id' => $user->getId()));
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }


            $name = trim($request->request->get('name', ''));
            $value = $request->request->get('value', '');
            $pk = trim($request->request->get('pk', ''));

            switch ($name) {
                case 'firstName':
                    if (!empty($value)) {
                        $entity->setFirstName($value);
                    }
                    break;
                case 'lastName':
                    if (!empty($value)) {
                        $entity->setLastName($value);
                    }
                    break;
                case 'jobTitle':
                    if (!empty($value)) {
                        $entity->setJobTitle($value);
                    }
                    break;
                case 'email':
                    if (!empty($value)) {
                        $entity->setEmail($value);
                    }
                    break;
                case 'birthday':
                    $d = new \DateTime();
                    $d->setDate($value, 1, 1);
                    $entity->setBirthday($d);
                    break;
                case 'sex':
                    if ($value == '') {
                        $value = '0';
                    }
                    $entity->setSex($value);
                    break;
                case 'phone':
                    $entity->setPhone($value);
                    break;
                case 'summary':
                    $entity->setSummary($value);
                    break;
                case 'researchInterests':
                    $entity->setResearchInterests($value);
                    break;

                case 'categoriesJson':
                    if (!empty($value)) {

                    }
                    break;
            }
            $em->persist($entity);
            $em->flush();

            return new JsonResponse(array('status' => 200));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function updateJobsHistoryAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if (empty($user)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyDataSourceBundle:Resume')
                ->findOneBy(array('user_id' => $user->getId()));
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }

            $cid = $request->request->get('cid', '');
            $cname = $request->request->get('cname', '');
            $ctitle = $request->request->get('ctitle', '');
            $cstartTime = $request->request->get('cstart_time', '');
            $cendTime = $request->request->get('cend_time', '');
            $cdescription = $request->request->get('cdescription', '');
            $ccurrentJob = $request->request->get('ccurrent_job', 0);
            $corder = $request->request->get('corder', 0);

            $experience = (!$entity->getJobHistoryJson()) ? array() : json_decode($entity->getJobHistoryJson(), true);

            if (empty($corder)) {
                $corder = count($experience);
            }
            $key = ProfileHelper::getKeyById($experience, $cid);
            $item = array(
                'id' => $cid,
                'name' => $cname,
                'title' => $ctitle,
                'start_time' => $cstartTime,
                'end_time' => $cendTime,
                'description' => $cdescription,
                'current_job' => $ccurrentJob,
                'group' => '',
                'order' => $corder,
            );
            if ($key == -1) {
                //add new
                $item['id'] = time();
                $experience[] = $item;
            } else {
                //update
                if ($ccurrentJob == 1) {
                    $experience = ProfileHelper::resetCurrentJob($experience);
                }
                $experience[$key] = $item;
            }
            $entity->setJobHistoryJson(json_encode($experience));


            $em->persist($entity);
            $em->flush();

            $html = $this->render('@MyFrontend/User/_jobs_history.html.twig',
                array('json' => json_encode($experience)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function removeJobsHistoryProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if (empty($user)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyDataSourceBundle:Resume')
                ->findOneBy(array('user_id' => $user->getId()));
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $cid = $request->request->get('cid', '');

            $experience = (!$entity->getJobHistoryJson()) ? array() : json_decode($entity->getJobHistoryJson(), true);

            ProfileHelper::remove($experience, $cid);
            $entity->setJobHistoryJson(json_encode($experience));

            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_jobs_history.html.twig',
                array('jobHistoryJson' => json_encode($experience)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function updateSkillAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $sid = $request->request->get('sid', '');
            $sname = $request->request->get('sname', '');
            $slevel = $request->request->get('slevel', '');
            $sverified = $request->request->get('sverified', '');

            $skills = (!$entity->getSkillJson()) ? array() : json_decode($entity->getSkillJson(), true);

            $key = ProfileHelper::getKeyById($skills, $sid);
            $item = array(
                'id' => $sid,
                'name' => $sname,
                'level' => $slevel,
                'verified' => $sverified,
            );
            if ($key == -1) {
                //add new
                $item['id'] = time();
                $skills[] = $item;
            } else {
                //update
                $skills[$key] = $item;
            }
            $entity->setSkillJson(json_encode($skills));


            $em->persist($entity);
            $em->flush();

            $html = $this->render('@MyFrontend/User/_skill.html.twig',
                array('json' => json_encode($skills)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function removeSkillAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $sid = $request->request->get('sid', '');

            $skill = (!$entity->getSkillJson()) ? array() : json_decode($entity->getSkillJson(), true);

            ProfileHelper::remove($skill, $sid);
            $entity->setSkillJson(json_encode($skill));

            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_skill.html.twig',
                array('skillJson' => json_encode($skill)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }


    public function updateEducationAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $eid = $request->request->get('eid', '');
            $ename = $request->request->get('ename', '');
            $emajor = $request->request->get('emajor', '');
            $estartTime = $request->request->get('estart_time', '');
            $eendTime = $request->request->get('eend_time', '');
            $eorder = $request->request->get('eorder', 0);

            $education = (!$entity->getEducationJson()) ? array() : json_decode($entity->getEducationJson(), true);

            if (empty($eorder)) {
                $eorder = count($education);
            }
            $key = ProfileHelper::getKeyById($education, $eid);
            $item = array(
                'id' => $eid,
                'name' => $ename,
                'major' => $emajor,
                'start_time' => $estartTime,
                'end_time' => $eendTime,
                'order' => $eorder,
            );
            if ($key == -1) {
                //add new
                $item['id'] = time();
                $education[] = $item;
            } else {
                //update
                $education[$key] = $item;
            }
            $entity->setEducationJson(json_encode($education));


            $em->persist($entity);
            $em->flush();

            $html = $this->render('@MyFrontend/User/_education.html.twig',
                array('json' => json_encode($education)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function removeEducationAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $eid = $request->request->get('eid', '');

            $education = (!$entity->getEducationJson()) ? array() : json_decode($entity->getEducationJson(), true);

            ProfileHelper::remove($education, $eid);
            $entity->setEducationJson(json_encode($education));

            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_education.html.twig',
                array('educationJson' => json_encode($education)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    private function getPathCDN(Request $request)
    {
        return dirname($this->get('kernel')->getRootDir()) . '/web/cdn/upload/';
    }

    private function getImageFromCdn($filename)
    {
        return "cdn/upload/{$filename}";
    }

    public function updatePhotoAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if (empty($user)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyDataSourceBundle:Resume')
                            ->findOneBy(array('user_id' => $user->getId()));
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }


            $cdnPath = $this->getPathCDN($request);
            //---------------
            $target_file = $cdnPath . basename($_FILES['file']["name"]);

            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES['file']["tmp_name"]);
                if ($check === false) {
                    return new JsonResponse(array('status' => 400, 'msg' => 'file is not an image'));
                }
            }

            // Check file size
            if ($_FILES['file']["size"] > 1000000) {
                return new JsonResponse(array('status' => 400, 'msg' => 'sorry, your file is too large'));
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                return new JsonResponse(array('status' => 400, 'msg' => 'sorry, only JPG, JEPG, GIT files are allow'));
            }

            $genrateFileName = time() . '.' . $imageFileType;
            if (!move_uploaded_file($_FILES['file']["tmp_name"], $cdnPath . $genrateFileName)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'sorry, there was an error uploading your file'));
            }

            $entity->setPhoto($genrateFileName);
            $newUrl = $this->generateUrl('my_frontend_photo_view', array('filename' => $genrateFileName, 'size' => '300x300'), UrlGeneratorInterface::ABSOLUTE_URL);

            $em->persist($entity);
            $em->flush();

            return new JsonResponse(array('status' => 200, 'newurl' => $newUrl, 'mgs' => 'your file has uploaded successful'));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function viewPhotoAction(Request $request, $filename, $size)
    {
        $path = $this->getImageFromCdn($filename);

        if (is_file($path)) {
            // RedirectResponse object
            $imagemanagerResponse = $this->container
                ->get('liip_imagine.controller')
                ->filterAction($request,        // http request
                    $path,       // original image you want to apply a filter to
                    $size  // filter defined in config.yml
                );

            // string to put directly in the "src" of the tag <img>
            $cacheManager = $this->container->get('liip_imagine.cache.manager');
            $srcPath = $cacheManager->getBrowserPath($path, $size);
            $fp = fopen($srcPath, "rb");
            $file = stream_get_contents($fp);
        } else {
            $default = dirname($this->getPathCDN($request)) . '/300x300.png';
            $fp = fopen($default, "rb");
            $file = stream_get_contents($fp);
        }

        $response = new Response($file, 200);
        $response->headers->set('Content-Type', 'image/png');
        return $response;
    }
}
