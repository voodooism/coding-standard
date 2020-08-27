<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Sniffs\Functions;

use SlevomatCodingStandard\Sniffs\TestCase;

class RequireMultiLineCallSniffTest extends TestCase
{

	public function testNoErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/requireMultiLineCallNoErrors.php');
		self::assertNoSniffErrorInFile($report);
	}

	public function testErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/requireMultiLineCallErrors.php');

		self::assertSame(11, $report->getErrorCount());

		self::assertSniffError($report, 7, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of method doAnything() should be splitted to more lines.');
		self::assertSniffError($report, 9, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function sprintf() should be splitted to more lines.');
		self::assertSniffError($report, 11, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Constructor call should be splitted to more lines.');
		self::assertSniffError($report, 15, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function printf() should be splitted to more lines.');
		self::assertSniffError($report, 17, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function array_merge() should be splitted to more lines.');
		self::assertSniffError($report, 21, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function array_map() should be splitted to more lines.');
		self::assertSniffError($report, 24, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function array_merge() should be splitted to more lines.');
		self::assertSniffError($report, 29, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function doSomethingElse() should be splitted to more lines.');
		self::assertSniffError($report, 31, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function in_array() should be splitted to more lines.');
		self::assertSniffError($report, 33, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of function sprintf() should be splitted to more lines.');
		self::assertSniffError($report, 36, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL, 'Call of method doSomething() should be splitted to more lines.');

		self::assertAllFixedInFile($report);
	}

	public function testAllCallsNoErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/requireMultiLineCallAllCallsNoErrors.php', [
			'minLineLength' => 0,
		]);
		self::assertNoSniffErrorInFile($report);
	}

	public function testAllCallsErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/requireMultiLineCallAllCallsErrors.php', [
			'minLineLength' => 0,
		]);

		self::assertSame(1, $report->getErrorCount());

		self::assertSniffError($report, 7, RequireMultiLineCallSniff::CODE_REQUIRED_MULTI_LINE_CALL);

		self::assertAllFixedInFile($report);
	}

}