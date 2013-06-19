<?php
//This File needs ghostprint installed and gsview on the system path, also given with the server's permission
class Printee{
	function Printee($directory,$file,$printerName){
		$this->fileDirectory=$directory;
		$this->file=$file;
		$this->printerName=$printerName;
		$this->printPath = $directory.$file;
	}
	function printNow(){
		$returnval = system('gsprint.exe "'.$this->printPath.'" -printer "'.$this->printerName.'"  2>&1');
		return $returnval;
	}
	function deleteFile(){
		unlink($this->printPath);
	}

}
?>
