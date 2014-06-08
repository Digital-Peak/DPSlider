<?php

/**
 * @package		DPSlider
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright	Copyright (C) 2012 - 2014 Digital Peak. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

/**
 * Build release files for the DPSlider module.
 */
class DPSliderReleaseBuild
{

	public function build ()
	{
		$root = dirname(dirname(__FILE__));
		$buildDir = dirname(__FILE__);
		$dpVersion = new SimpleXMLElement(file_get_contents(dirname(__FILE__) . '/../mod_dpslider/mod_dpslider.xml'));
		$dpVersion = (string) $dpVersion->version;

		$dpVersion = str_replace('.', '_', $dpVersion);

		exec('rm -rf ' . $buildDir . '/dist');
		exec('rm -rf ' . $buildDir . '/build');

		mkdir($buildDir . '/dist');
		mkdir($dpDir);

		$this->createZip($root . '/mod_dpslider', $buildDir . '/dist/mod_dpslider_' . $dpVersion . '.zip');
	}

	private function createZip ($folder, $zipFile, $excludes = array(), $substitutes = array())
	{
		$root = dirname(dirname(__FILE__));

		$zip = new ZipArchive();
		$zip->open($zipFile, ZIPARCHIVE::CREATE);

		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder), RecursiveIteratorIterator::LEAVES_ONLY);

		foreach ($files as $name => $file)
		{
			// Get real path for current file
			$filePath = $file->getRealPath();
			$fileName = str_replace($root . '/', '', $filePath);
			$fileName = str_replace('suite_build/build/mod_dpslider', '', $fileName);

			$ignore = false;
			foreach ($excludes as $exclude)
			{
				if (strpos($fileName, $exclude) !== false)
				{
					$ignore = true;
					break;
				}
			}

			if ($ignore || is_dir($filePath))
			{
				continue;
			}
			if (key_exists($fileName, $substitutes))
			{
				$fileName = $substitutes[$fileName];
			}

			$fileName = trim($fileName, '/');

			// Add current file to archive
			$zip->addFile($filePath, $fileName);
		}

		$zip->close();
	}
}

$build = new DPSliderReleaseBuild();
$build->build();
