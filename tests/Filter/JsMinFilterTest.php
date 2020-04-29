<?php
declare(strict_types=1);

namespace WebLoader\Test\Filter;

use PHPUnit\Framework\TestCase;
use WebLoader\Compiler;
use WebLoader\DefaultOutputNamingConvention;
use WebLoader\FileCollection;
use WebLoader\Filter\JsMinFilter;

class JsMinFilterTest extends TestCase
{
	/** @var JsMinFilter */
	private $filter;

	/** @var Compiler */
	private $compiler;


	protected function setUp(): void
	{
		$this->filter = new JsMinFilter();

		$files = new FileCollection(__DIR__ . '/../fixtures');
		@mkdir($outputDir = __DIR__ . '/../temp/');
		$this->compiler = new Compiler($files, new DefaultOutputNamingConvention(), $outputDir);
	}


	public function testMinify(): void
	{
		$file = __DIR__ . '/../fixtures/jsmin.js';
		$minified = $this->filter->__invoke(
			(string) file_get_contents($file),
			$this->compiler,
			$file
		);
		$this->assertSame(file_get_contents(__DIR__ . '/../fixtures/jsmin.js.expected'), $minified);
	}
}
