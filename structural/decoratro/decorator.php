<?php

/**
 * Decorator Pattern
 */

/**
 * base component
 */
interface InputFormat
{
	public function filterText(string $text);
}

/**
 * The Concrete Component is a core element of decoration.
 */
class TextInput implements InputFormat
{
    public function filterText(string $text)
    {
        return $text;
    }
}



/**
 *  base class decorator
 */
class TextFormat implements InputFormat
{
	public InputFormat $wrapper;

	function __construct(InputFormat $inputFormat)
	{
		$this->wrapper = $inputFormat;
	}

	public function filterText(string $text)
	{
		return $this->wrapper->filterText($text);
	}
}

/**
 * Strip html tags
 */
class StripHtmlTags extends TextFormat
{
	public function filterText(string $text)
	{
		$text = parent::filterText($text);

		return strip_tags($text);
	}
}

/**
 * Strip Javascript tags
 */
class StripJsTags extends TextFormat
{
	public function filterText(string $text)
	{
		$text = parent::filterText($text);

		return preg_replace("|<script.*?>([\s\S]*)?</script>|i", '', $text);
	}
}



// Client code

$text = "Dummy text, and this is image html tags <img />, and this is a javascript tags <script> console.log() </script>";

// Plain text which is unsafe
$textInput = new TextInput();
echo $textInput->filterText($text);
echo "\n \n";


// Call base decorator
// filter html tags
// filter js tags

$textFormat = new TextFormat($textInput);
$sht = new StripHtmlTags($textFormat);
$sjs = new StripJsTags($sht);

echo $sjs->filterText($text);


