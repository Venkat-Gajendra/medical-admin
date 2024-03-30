<?php

// Define constants
define('datalist_filters_count', 20);
define('datalist_image_uploads_exist', true);
define('datalist_max_records_multi_selection', 1000);
define('datalist_max_page_lump', 50);
define('datalist_max_records_dv_print', 100);
define('datalist_auto_complete_size', 1000);
define('datalist_date_separator', '/');
define('datalist_date_format', 'mdY');

// Include necessary files
$curr_dir = dirname(__FILE__);
require_once($curr_dir . '/combo.class.php');
require_once($curr_dir . '/data_combo.class.php');
require_once($curr_dir . '/date_combo.class.php');

class DataList {
    // Class variables
    var $QueryFieldsTV,
        $QueryFieldsCSV,
        $QueryFieldsFilters,
        $QueryFieldsQS,
        $QueryFrom,
        $QueryWhere,
        $QueryOrder,
        $filterers,

        $ColWidth, // array of field widths
        $DataHeight,
        $TableName,

        $AllowSelection,
        $AllowDelete,
        $AllowMassDelete,
        $AllowDeleteOfParents,
        $AllowInsert,
        $AllowUpdate,
        $SeparateDV,
        $Permissions,
        $AllowFilters,
        $AllowSavingFilters,
        $AllowSorting,
        $AllowNavigation,
        $AllowPrinting,
        $HideTableView,
        $AllowCSV,
        $CSVSeparator,

        $QuickSearch, // 0 to 3

        $RecordsPerPage,
        $ScriptFileName,
        $RedirectAfterInsert,
        $TableTitle,
        $PrimaryKey,
        $DefaultSortField,
        $DefaultSortDirection,

        // Template variables
        $Template,
        $SelectedTemplate,
        $TemplateDV,
        $TemplateDVP,
        $ShowTableHeader, // 1 = show standard table headers
        $ShowRecordSlots, // 1 = show empty record slots in table view
        $TVClasses,
        $DVClasses,
        // End of template variables

        $ContentType, // set by DataList to 'tableview', 'detailview', 'tableview+detailview', 'print-tableview', 'print-detailview' or 'filters'
        $HTML; // generated html after calling Render()

    function __construct() { // PHP 7 compatibility
        $this->DataList();
    }

    function DataList() { // Constructor function
        $this->DataHeight = 150;

        $this->AllowSelection = 1;
        $this->AllowDelete = 1;
        $this->AllowInsert = 1;
        $this->AllowUpdate = 1;
        $this->AllowFilters = 1;
        $this->AllowNavigation = 1;
        $this->AllowPrinting = 1;
        $this->HideTableView = 0;
        $this->QuickSearch = 0;
        $this->AllowCSV = 0;
        $this->CSVSeparator = ",";
        $this->HighlightColor = '#FFF0C2'; // default highlight color

        $this->RecordsPerPage = 10;
        $this->Template = '';
        $this->HTML = '';
        $this->filterers = array();
    }

    // Other class methods...
}

// Instantiate DataList class
$datalist = new DataList();

?>
