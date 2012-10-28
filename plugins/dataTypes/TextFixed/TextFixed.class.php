<?php

class DataType_TextFixed extends DataTypePlugin {
	protected $dataTypeName = "Fixed Number of Words";
	protected $dataTypeFieldGroup = "text";
	protected $dataTypeFieldGroupOrder = 10;
	protected $jsModules = array("TextFixed.js");

	private $helpDialogWidth = 370;


	public function generate($row, $options, $existingRowData) {
	// global $g_words;
		return gd_generate_random_text_str($g_words, false, "fixed", $options);
	}

	public function getExportTypeInfo($exportType, $options) {
		$info = "";
		switch ($export_type)
		{
			case "sql":
				if ($options == "MySQL" || $options == "SQLite")
					$info = "TEXT default NULL";
				else if ($options == "Oracle")
					$info = "BLOB default NULL";
				break;
		}

		return $info;
	}

	public function getRowGenerationOptions($postdata, $column, $numCols) {
		if (empty($postdata["numWords_$col"]))
			return false;

		return $postdata["numWords_$col"];
	}

	public function getOptionsColumnHTML() {
		$html =<<<END
&nbsp;{$this->L["TextFixed_generate"]} #<input type="text" name="dtNumWords_%ROW%" id="dtNumWords_%ROW%" style="width: 30px" value="10" />
{$this->L["TextFixed_words"]}
END;
		return $html;
	}

	public function getHelpDialogInfo() {
		return array(
			"dialogWidth" => $this->helpDialogWidth,
			"content"     => "<p>{$this->L["TextFixed_help"]}</p>"
		);
	}
}
