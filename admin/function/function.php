<?php

	function generate_token()
	{
		$sToken = sha1(uniqid(rand()));

		if(isset($sToken))
		{
			$_SESSION['token'] = $sToken;
		}

		return $sToken;
	}

	function clean_input($value)
	{
		if(isset($value) && !empty($value))
		{
			$value = htmlspecialchars(addslashes(trim($value)));

			return $value;
			exit();
		}
	}

	function upload_quotation_file($cmd, $amount=0, $file, $quote_id)
	{
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($file["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$msg = '';

		global $objQuotes;

		if(isset($cmd))
		{ 
			if(isset($file))
			{
				if($file['size'] > 5000000)  //5mb
				{
					$msg .= "Your file is bigger than 5mb <br>";
				}

				if($imageFileType != "pdf")
				{
					$msg .= "File must be a pdf <br>";
				}

				if (move_uploaded_file($file["tmp_name"], $target_file))
				{
			        $msg .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
			    } 
			    else 
			    {
			        $msg .= "Sorry, there was an error uploading your file.<br>";
			    }
			}
			
			$objQuotes->updateQuote($quote_id, $file["name"], $amount);
		}
	}

	function uploadticket_files($files)
	{
		$targetDir = "../system/ticketuploads/";
		$uploadOK = 1;
		$tempFiles = [];
		$targetFiles = [];

		if(!file_exists("../system/ticketuploads/"))
		{
			$targetDir = mkdir("../system/ticketuploads/", 0700);
		}
		
		foreach($files["files"] as $key => $multipleFiles) 
		{ 
			if($key === "name")
			{	
				foreach($multipleFiles as $file) 
				{
					$targetFiles[] = $targetDir . basename($file);
				}
			}	
				
				
			if($key === "tmp_name")
			{
				foreach($multipleFiles as $file) 
				{
					$imageSize = getimagesize($file);

					if($imageSize === FALSE)
					{
						die("File is not an image !!!");
						$uploadOK = 0;
					}
				}

				$tempFiles[] = $file;
			}
				

			if($key === "size")
			{
				foreach($multipleFiles as $value) 
				{
					if($file["size"] > 2000000)
					{
						die("File is larger than 2mb");
						$uploadOK = 0;
					}
				}
			}


			
			foreach($targetFiles as $targetFile)
			{
				$imageFileTypes[] = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
				if(file_exists($targetFile))
				{
					echo $targetFile;
					die("File already exists");
					$uploadOK = 0;
				}
			}
				

			

			foreach($imageFileTypes as $imageFileType) 
			{	
				if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif")
				{
					die("Only JPG, JPEG PNG GIF siles are allowed");
					$uploadOK = 0;
				}
			}	


			if($uploadOK === 1)
			{
				foreach ($tempFiles as $tempFile) {
				
					foreach ($targetFiles as $targetFile) {
					
						if(!move_uploaded_file($tempFile, $targetFile))
						{
							var_dump($multipleFiles);
							die("Sorry, there was an error uploading your file !!! {$tempFile}  =>  {$targetFile}");
						}	
					}
				}
			}	
		} die;
	}
?>
