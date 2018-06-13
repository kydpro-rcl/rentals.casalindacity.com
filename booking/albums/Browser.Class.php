<?php
date_default_timezone_set('Asia/Calcutta');
class Browser {
    const cUsername = "admin";
    const cPassword = "password";
    public $separator, $sMessage = 0, $sError = 0;
    private $aPlainText = array('as','asp','aspx','atom','bat','cfm','cmd','hta','htm','html','js','jsp','java','mht','php','pl','py','rb','rss','sh','txt','xhtml','xml','log','out','ini','shtml','xsl','xslt','backup');
    private $aImageType = array('bm','bmp','ras','rast','fif','flo','turbot','g3','gif','ief','iefs','jfif','jfif-tbnl','jpe','jpeg','jpg','jut','nap','naplps','pic','pict','jfif','jpe','jpeg','jpg','png','x-png','tif','tiff','mcf','dwg','dxf','svf','fpx','fpx','rf','rp','wbmp','xif','xbm','ras','dwg','dxf','svf','ico','art','jps','nif','niff','pcx','pct','xpm','pnm','pbm','pgm','pgm','ppm','qif','qti','qtif','rgb','tif','tiff','bmp','xbm','xbm','pm','xpm','xwd','xwd');

    public function __construct($bAuth){
     /*   if ($bAuth) {
            if ($_POST['button'] == 'Login') {
                if (($_POST['username'] == self::cUsername) && ($_POST['password'] == self::cPassword)) {
                    $_SESSION['auth'] = "1";
                }else{
                    $_SESSION['auth'] = "0";
                }
            }
            if (!$_SESSION['auth']) {
                $sHtml = "<form method=\"post\">
                        <table style=\"background-color:#ffffff; padding: 1em; border:1px solid #000000;\" border=\"0\" cellpadding=\"0\" cellspacing=\"2\" width=\"200\" align=\"center\">
                            <tr>
                                <td style=\"background-color:#F1F1F1\" colspan=\"2\">Login</td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><input type=\"text\" name=\"username\" id=\"username\"/></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type=\"password\" name=\"password\" id=\"password\"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type=\"submit\" name=\"button\" id=\"button\" value=\"Login\"/></td>
                            </tr>
                        </table>
                        </form>";
                echo $sHtml;
                die();
            }
        } */
        if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
            $this->separator = "\\";
        } else {
            $this->separator = "/";
        }
    }



    public function downloadFile($file){
        header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Type: application/octet-stream');
        readfile($file);
    }
    public function fileName($file, $dir){
        if (filetype($dir.$file) != "dir") {
            $sLink = /*"<a href=\"browser.php?view=".urlencode($dir.$file)."\">*/$file/*</a>"*/;
        }
        else{
            $aCurrentPath = explode($this->separator, $dir);
            $iCount = (count($aCurrentPath) -2);
            for ($i = 0; $i < $iCount; ++$i) {
                $sFullPath .= $aCurrentPath[$i].$this->separator;
            }
            if ($file == '.') {
                $sLink = "<a href=\"browser.php?dir=".$this->separator."\">[ ".$this->separator." ]</a>";
            }elseif ($file == '..') {
                $sLink = "<a href=\"browser.php?dir=".$sFullPath."\">[ ".$this->separator." ".$this->separator." ]</a>";
            }
            else{
                $sLink =/* "<a href=\"browser.php?dir=".urlencode($dir.$file)."\">*/$file/*</a>"*/;
            }
        }
        return $sLink;
    }
     public function fileView($file, $dir){
        if (filetype($dir.$file) != "dir") {
            $sLink = "<a href=\"browser.php?view=".urlencode($dir.$file)."\" target=\"_blank\">Open</a>";
        }
        else{
            $aCurrentPath = explode($this->separator, $dir);
            $iCount = (count($aCurrentPath) -2);
            for ($i = 0; $i < $iCount; ++$i) {
                $sFullPath .= $aCurrentPath[$i].$this->separator;
            }
            if ($file == '.') {
                $sLink = "<a href=\"browser.php?dir=".$this->separator."\">[ ".$this->separator." ]</a>";
            }elseif ($file == '..') {
                $sLink = "<a href=\"browser.php?dir=".$sFullPath."\">[ ".$this->separator." ".$this->separator." ]</a>";
            }
            else{
                $sLink = "<a href=\"browser.php?dir=".urlencode($dir.$file)."\">$file</a>";
            }
        }
        return $sLink;
    }
    public function showDownload($file, $dir = ""){
        if (filetype($dir.$file) != "dir") {
            return "<a href=\"browser.php?dwl=urlencode($dir$file\">Download</a>";
        }else{
            return '';
        }
    }
    public function showEdit($file, $dir){
        if (filetype($dir.$file) != "dir") {
            $sExt = strtolower(substr(strrchr($file,'.'),1));
            if ($sExt == 'zip') {
                $sLink = "<a href=\"browser.php?extract=urlencode($dir$file)\">Unpack</a>";
            }else{
                $sLink = "<a href=\"browser.php?edit=urlencode($dir$file)\" target=\"_new\">Edit</a>";
            }
        }
        return $sLink;
    }
    public function showFileSize($file, $dir, $precision = 2) {
        if (filetype($dir.$file) != "dir") {
            return $this->formatSize(filesize($dir.$file));
        }else{
            return "Dir";
        }
    }
    private function formatSize($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
    public function dateFormat($iTimestamp) {
        return date("F j, Y, g:i a", $iTimestamp);
    }
    public function delete_directory($dirname) {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    if (@unlink($dirname."/".$file)) {
                        $this->sMessage = "Directory Deleted Successfully: \"".$dirname."\" .";
                    }
                    else{
                        $this->sError = "Can't Deleted Directory \"".$dirname."\" .";
                    }
                    else
                        $this->delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
    public function viewFile($file){
        $sBaseName = basename($file);
        $sExt = strtolower(substr(strrchr($sBaseName,'.'),1));
        if ($sExt == "zip") {
            $oZip = new ZipArchive;
            if ($oZip->open($file) === TRUE) {
                echo "<table cellspacing=\"1px\" cellpadding=\"0px\">";
                echo "<tr><th>Name</th><th>Uncompressed size</th><th>Compressed size</th><th>Compr. ratio</th><th>Date</th></tr>";
                for ($i=0; $i<$oZip->numFiles;$i++) {
                    $aZipDtls = $oZip->statIndex($i);
                    $iPercent = round($aZipDtls['comp_size'] * 100 / $aZipDtls['size']);
                    $iUncompressedSize = $aZipDtls['size'];
                    $iCompressedSize = $aZipDtls['comp_size'];
                    $iTotalPercent += $iPercent;
                    echo "<tr><td>".$aZipDtls['name']."</td><td>".$this->formatSize($iUncompressedSize)."</td><td>".$this->formatSize($iCompressedSize)."</td><td>".$iPercent."%</td><td>".$this->dateFormat($aZipDtls['mtime'])."</td></tr>";
                }
                echo "</table>";
                echo "<p align=\"center\"><b>".$this->showFileSize($file, $dir)." in ".$oZip->numFiles." files in ".basename($oZip->filename).". Compression ratio: ".round($iTotalPercent / $oZip->numFiles)."%</b></p>";
                $oZip->close();
            } else {
                echo 'failed';
            }
        }elseif (in_array($sExt, $this->aPlainText)) {
            header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Description: File View');
            header('Content-Length: ' . filesize($file));
            header('Content-Disposition: inline; filename=' . basename($file));
            header('Content-Type: text/plain');
            readfile($file);
        }elseif(in_array($sExt, $this->aImageType)){
            header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Description: File View');
            header('Content-Length: ' . filesize($file));
            header('Content-Disposition: inline; filename=' . basename($file));
            header('Content-Type: image/jpg');
            readfile($file);
        }else{
            $this->downloadFile($file);
        }
    }
    public function deleteFiles($aFiles){
        if (is_array($aFiles)) {
            foreach ($aFiles as $aFilesNames){
                if (is_dir($dir.$aFilesNames)) {
                    $this->delete_directory($dir.$aFilesNames);
                }
                else{
                    if (@unlink($dir.$aFilesNames)) {
                        $this->sMessage = "File Deleted Successfully: \"".$dir.$aFilesNames."\" .";
                    }else{
                        $this->sError = "Can't Deleted file \"".$dir.$aFilesNames."\" .";
                    }
                }
            }
        }
    }
    public function createFile($dir, $sCreatefile){
        if (!file_exists($dir.$sCreatefile)) {
            if (is_writable($dir)) {
                $handle = fopen($dir.$sCreatefile, "w");
                fclose($handle);
                $this->sMessage = "File Created Successfully: \"$sCreatefile\" .";
            }else{
                $this->sError = "Directory Not Writable, Can't Create file.";
            }
        }
        else{
            $this->sError = " \"$sCreatefile\" File already exist.";
        }
    }
    private function writeBackup($sFileName){
        if (!copy($sFileName, $sFileName.".backup")) {
            return false;
        }
        return true;
    }
    public function fileWriter($sFile, $string, $backup = false) {
        if ($backup) {
            $this->writeBackup($sFile);
        }
        $fp = fopen($sFile,"w");
        //Writing to a network stream may end before the whole string is written. Return value of fwrite() is checked
        for ($written = 0; $written < strlen($string); $written += $fwrite) {
            $fwrite = fwrite($fp, substr($string, $written));
            if (!$fwrite) {
                return $fwrite;
            }
        }
        fclose($fp);
        return $written;
    }
    public function createDirectory($dir, $sCreatefile){
        if (!is_dir($dir.$sCreatefile)) {
            mkdir($dir.$sCreatefile, 0755);
            $this->sMessage = "Directory Created Successfully: \"$dir\" .";
        }else{
            $this->sError = "\"$dir\" Directory already exist.";
        }
    }
    public function extract($sExtract){
        $path_parts = pathinfo($sExtract);
        if (is_writable($path_parts['dirname'])) {
            $zip = new ZipArchive;
            if ($zip->open($sExtract) === TRUE) {
                $zip->extractTo($path_parts['dirname']);
                $zip->close();
                echo 'ok';
            } else {
                echo 'failed';
            }
        }
        else{
            $this->sError = "\"".$path_parts['dirname']."\" Directory is not writable..";
        }
    }
    public function uploadFile($dir, $sFileName){
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $dir.$sFileName)) {
            $this->sMessage = "\"$sFileName\" File Successfully Uploaded.";
        }
        else{
            $this->sError = "\"$sFileName\" Uploading Error.";
        }
    }
    public function getCurrentDir($dir){
        $aCurrentPath = explode($this->separator, $dir);
        $iCount = (count($aCurrentPath) -1);
        for ($i = 0; $i < $iCount; ++$i) {
            $sFullPath .= $aCurrentPath[$i].$this->separator;
            echo "<a href=\"browser.php?dir=".urlencode($sFullPath)."\"><strong>".$aCurrentPath[$i]."<strong></a>".$this->separator;
        }
    }
    public function readContent($sEdit, &$contents = null){
        if (file_exists($sEdit)) {
            $handle = fopen($sEdit, "r");
            if ($handle) {
                while (!feof($handle)) {
                    $contents .= fgets($handle, 4096);
                }
                fclose($handle);
            }
        }
    }
}
