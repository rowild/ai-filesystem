<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2020
 * @package MW
 * @subpackage Filesystem
 */


namespace Aimeos\MW\Filesystem;

use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;


/**
 * Implementation of Flysystem Zip archive file system adapter
 *
 * @package MW
 * @subpackage Filesystem
 */
class FlyZip extends FlyBase implements Iface, DirIface, MetaIface
{
	private $fs;


	/**
	 * Returns the file system provider
	 *
	 * @return \League\Flysystem\FilesystemInterface File system provider
	 */
	protected function getProvider()
	{
		if( !isset( $this->fs ) )
		{
			$config = $this->getConfig();

			if( !isset( $config['filepath'] ) ) {
				throw new Exception( sprintf( 'Configuration option "%1$s" missing', 'filepath' ) );
			}

			$this->fs = new Filesystem( new ZipArchiveAdapter( $config['filepath'] ) );
		}

		return $this->fs;
	}
}
