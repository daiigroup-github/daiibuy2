<?php

class GenerateAllExtendModelCommand extends CConsoleCommand
{

	public function run()
	{
		$modelExtendPath = Yii::app()->basePath . '/components/ModelExtend.txt';

		if($handle = opendir(Yii::app()->basePath . '/models'))
		{

			/* This is the correct way to loop over the directory. */
			while(false !== ($fileName = readdir($handle)))
			{
				if($fileName == '.' || $fileName == '..')
					continue;

				$arr = preg_split('/(?=[A-Z])/', $fileName);

				if(end($arr) == 'Master.php')
				{
					array_shift($arr);
					array_pop($arr);

					$modelName = implode('', $arr);
					$modelPath = Yii::app()->basePath . '/models/' . $modelName . '.php';

					if(file_exists($modelPath))
					{
						continue;
						/*
						echo $modelName . '.php is already exist. Do you want to replace? [y/N]';

						flush();
						ob_flush();

						if(trim((fgets(STDIN))) === 'y')
						{
							copy($modelExtendPath, $modelPath);

							$content = str_replace('{MODEL}', $modelName, file_get_contents($modelPath));
							file_put_contents($modelPath, $content);
						}
						*/
					}
					else
					{
						copy($modelExtendPath, $modelPath);

						$content = str_replace('{MODEL}', $modelName, file_get_contents($modelPath));
						file_put_contents($modelPath, $content);
					}
				}
			}

			closedir($handle);
		}
	}

}
