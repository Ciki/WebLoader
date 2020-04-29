<?php
declare(strict_types=1);

namespace WebLoader\Test\Filter;

use PHPUnit\Framework\TestCase;
use WebLoader\Compiler;
use WebLoader\DefaultOutputNamingConvention;
use WebLoader\FileCollection;
use WebLoader\Filter\CssMinFilter;

class CssMinFilterTest extends TestCase
{
	/** @var CssMinFilter */
	private $filter;

	/** @var Compiler */
	private $compiler;


	protected function setUp(): void
	{
		$this->filter = new CssMinFilter();

		$files = new FileCollection(__DIR__ . '/../fixtures');
		@mkdir($outputDir = __DIR__ . '/../temp/');
		$this->compiler = new Compiler($files, new DefaultOutputNamingConvention(), $outputDir);
	}


	public function testMinify(): void
	{
		$file = __DIR__ . '/../fixtures/cssmin.css';
		$minified = $this->filter->__invoke(
			(string) file_get_contents($file),
			$this->compiler,
			$file
		);
		$this->assertSame(file_get_contents(__DIR__ . '/../fixtures/cssmin.css.expected'), $minified);
	}
}
