<?php
namespace Grandhotel\Hausnetz\Service;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class FileService {
    /**
     * @var \Grandhotel\Hausnetz\Service\EncryptionService
     * @Flow\Inject
     */
    protected $encryptionService;


    /**
     * @param $path
     * @return array|bool
     */
    public function getFileInfo($path) {
        if (file_exists($path)) {
            $explode = explode('/', $path);
            $explode = array_filter($explode);

            $last = array_pop($explode);
            $file = $last;
            $parent = array_pop($explode);

            if (is_dir($path)) {

                $cmd = 'LC_ALL=en_US.UTF-8 du -s "' . $path . '"';
                $size = exec($cmd);
                $sizeExp = explode(" ", $size);
                $size = intval(trim(array_shift($sizeExp)));
                $size *= 1024;

                $dt = new \DateTime();
                $dt->setTimestamp(filemtime($path));
                return array(
                    'isDirectory'           => TRUE,
                    'name'                  => $last,
                    'path'                  => $path,
                    'parent'                => $parent,
                    'size'                  => $size,
                    'mtime'                 => $dt,
                    'encrypted'             => $this->encryptionService->encrypt($path),
                    'enryptedAndEncoded'    => urlencode(base64_encode($this->encryptionService->encrypt($path))),
                );
            } else {
                $dt = new \DateTime();
                $dt->setTimestamp(filemtime($path));
                $exploded = explode('.', $file);
                $extension = array_pop($exploded);
                $extension = strtolower($extension);
                $isImage = in_array($extension, array('jpg', 'gif', 'png', 'jpeg', 'tif'));
                return array(
                    'isDirectory'           => FALSE,
                    'name'                  => $last,
                    'path'                  => $path,
                    'parent'                => $parent,
                    'mtime'                 => $dt,
                    'isImage'               => $isImage,
                    'size'                  => filesize($path),
                    'extension'             => $extension,
                    'encrypted'             => $this->encryptionService->encrypt($path),
                    'enryptedAndEncoded'    => urlencode(base64_encode($this->encryptionService->encrypt($path))),
                );
            }
        }
        return FALSE;
    }

    /**
     * @param string $directory
     * @return array
     */
    public function getFiles($directory = '') {
        $directory = str_replace('', '', $directory);
        $path = '/var/www/html/vhosts/Hausnetz/Data/Persistent/Resources/Files' . $directory;


        $directories = array();
        $explode = explode('/', $directory);
        $upper = -1;

        if (count($explode) > 1) {
            array_pop($explode);
            $upper = join('/', $explode);

        }
        if ($upper == -1 && $directory != '') {
            $upper = '';
        }
        //$this->view->assign('upperDirectory', $upper);
        $files = array(

        );
        if (file_exists($path) && is_dir($path)) {
            $temp = scandir($path);
            foreach ($temp as $file) {
                if ($file != '.' &&
                    $file != '..' &&
                    $file != '@eaDir' &&
                    $file != '.DS_Store' &&
                    $file != '.insync-trash') {

                    $filePath = $path . '/' . $file;
                    if (is_dir($filePath)) {
                        $directories[] = array(
                            'path' => $filePath,
                            'name' => $file,
                            'shortPath' => (($directory != '') ? $directory . '/' . $file : $file),
                            'encrypted' => $this->encryptionService->encrypt($filePath),
                            'enryptedAndEncoded' => urlencode(base64_encode($this->encryptionService->encrypt($filePath))),
                        );
                    } else {
                        $dt = new \DateTime();
                        $dt->setTimestamp(filemtime($filePath));

                        $exploded = explode('.', $file);
                        $extension = array_pop($exploded);
                        $extension = strtolower($extension);
                        $isImage = in_array($extension, array('jpg', 'gif', 'png', 'jpeg', 'tif'));

                        $files[] = array(
                            'path' => $filePath,
                            'name' => $file,
                            'mtime' => $dt,
                            'isImage' => $isImage,
                            'size' => filesize($filePath),
                            'extension' => $extension,
                            'encrypted' => $this->encryptionService->encrypt($filePath),
                            'encryptedAndEncoded' => urlencode(base64_encode($this->encryptionService->encrypt($filePath))),
                        );
                    }
                }
            }
        } else {
            return FALSE;
        }

        if ($upper) {
            $upperExp  = explode('/', $upper);
            $upperExp  = array_filter($upperExp);
            $upperLast = array_pop($upperExp);
        } else {
            $upperLast = '';
        }
        if ($directory) {
            $directoryExp  = explode('/', $directory);
            $directoryExp  = array_filter($directoryExp);
            $currentLast = array_pop($directoryExp);
        } else {
            $currentLast ='';
        }
        return array(
            'files'         => $files,
            'directories'   => $directories,
            'upperDirectory' => $upper,
            'upperLast' => $upperLast,
            'current' => $directory,
            'currentLast' => $currentLast,
        );
    }


    /**
     * @param string $fileName
     * @param string $localPath
     * @return string
     */
    public function getTempFileName($fileName = '', $localPath = '') {
        if (substr( $localPath, -1) != '/')  $localPath .= '/';

        $readPath = $localPath; //str_replace('/monacofriends/Kunden/', '/media/diskstation_customers/Kunden/', $remotePath);



        if (file_exists($localPath . $fileName)) {
            $exp = explode('.', $fileName);
            if (count($exp) > 1) {
                $extension = array_pop($exp);
            } else {
                $extension = '';
            }
            $fileNameNoExt = join('.', $exp);

            $exp = explode('_', $fileNameNoExt);
            if (count($exp) > 1) {
                $lastPart = array_pop($exp);
                if ((strlen($lastPart) == 3) && (str_replace(array(0,1,2,3,4,5,6,7,8,9), '', $lastPart) == '')) {
                    $number = (int) $lastPart;
                    $number++;
                    $fileNameNew = join('_', $exp);
                    $fileNameNew .= '_' . str_pad($number, 3, '0', STR_PAD_LEFT);
                    if ($extension != '') {
                        $fileNameNew .= '.' . $extension;
                    }
                    return $this->getTempFileName($fileNameNew, $localPath);
                } else {
                    $return = $fileNameNoExt . '_001';
                    if ($extension != '') {
                        $return .= '.' . $extension;
                    }
                    return $this->getTempFileName($return, $localPath);
                }
            } else {
                $return = $fileNameNoExt . '_001';
                if ($extension != '') {
                    $return .= '.' . $extension;
                }
                return $this->getTempFileName($return, $localPath);
            }
        } else {
            return $fileName;
        }
    }
    
    
    /**
     * @param string $file
     */
    public function inlineAction($file = '') {
       
        $file = $this->encryptionService->decrypt(base64_decode(urldecode($file)));
        if (file_exists($file) && !is_dir($file)) {
            $mime =mime_content_type($file);
            header('Content-type: ' . $mime);
            header('Content-Disposition: inline; filename=' . basename($file));
            readfile($file);
        }
        exit;
    }
    
    
    public function downloadAction($file = '') {
       
      header('Content-Transfer-Encoding: binary');
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . basename($file));
    }

}