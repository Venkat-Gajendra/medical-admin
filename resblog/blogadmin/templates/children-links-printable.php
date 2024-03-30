<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!isset($Translation)) {
    die('No direct access allowed.');
}

$current_table = 'links';
$cleaner = new CI_Input();
$cleaner->charset = datalist_db_encoding;

$param = [
    'ChildTable' => $cleaner->post('ChildTable'),
    'ChildLookupField' => $cleaner->post('ChildLookupField'),
    'SelectedID' => $cleaner->post('SelectedID'),
    'Page' => $cleaner->post('Page', true),
    'SortBy' => $cleaner->post('SortBy', true),
    'SortDirection' => $cleaner->post('SortDirection'),
    'AutoClose' => $config['auto-close'] ?? false
];

$panelID = "panel_{$param['ChildTable']}-{$param['ChildLookupField']}";
$mbWidth = min(max(window.innerWidth * 0.9, 500), 1000);
$mbHeight = min(max(window.innerHeight * 0.8, 300), 800);

$sort_direction = ($param['SortBy'] == $fieldIndex && $param['SortDirection'] == 'asc') ? 'desc' : 'asc';
$sort_icon = ($param['SortBy'] == $fieldIndex && $param['SortDirection'] == 'desc') ? 'glyphicon-sort-by-attributes-alt' : 'glyphicon-sort-by-attributes';

$records_display = '';
if (is_array($records)) {
    foreach ($records as $pkValue => $record) {
        $records_display .= '<tr>';
        foreach ($config['display-fields'] as $fieldIndex => $fieldLabel) {
            $field_name = "{$current_table}-{$config['display-field-names'][$fieldIndex]}";
            $records_display .= "<td class='{$field_name}' id='{$field_name}-{$record[$config['child-primary-key-index']]}'>" . safe_html($record[$fieldIndex]) . "</td>";
        }
        $records_display .= '</tr>';
    }
} else {
    $records_display = '<tr><td colspan="' . count($config['display-fields']) . '"><span class="text-danger" style="margin: 10px;">' . $Translation['No matches found!'] . '</span></td></tr>';
}
?>

<script>
    <?php echo $current_table; ?>GetChildrenRecordsList = function(command) {
        switch (command.Verb) {
            case 'sort':
                post("parent-children.php", {
                    ChildTable: param.ChildTable,
                    ChildLookupField: param.ChildLookupField,
                    SelectedID: param.SelectedID,
                    Page: param.Page,
                    SortBy: command.SortBy,
                    SortDirection: command.SortDirection,
                    Operation: 'get-records-printable'
                }, panelID, undefined, 'pc-loading');
                break;
            case 'page':
                if (command.Page.toLowerCase() == 'next') {
                    command.Page = param.Page + 1;
                } else if (command.Page.toLowerCase() == 'previous') {
                    command.Page = param.Page - 1;
                }

                if (command.Page < 1 || command.Page > <?php echo ceil($totalMatches / $config['records-per-page']); ?>) {
                    return;
                }

                post("parent-children.php", {
                    ChildTable: param.ChildTable,
                    ChildLookupField: param.ChildLookupField,
                    SelectedID: param.SelectedID,
                    Page: command.Page,
                    SortBy: param.SortBy,
                    SortDirection: param.SortDirection,
                    Operation: 'get-records-printable'
                }, panelID, undefined, 'pc-loading');
                break;
            case 'reload':
                post("parent-children.php", {
                    ChildTable: param.ChildTable,
                    ChildLookupField: param.ChildLookupField,
                    SelectedID: param.SelectedID,
                    Page: param.Page,
                    SortBy: param.SortBy,
                    SortDirection: param.SortDirection,
                    Operation: 'get-records-printable'
                }, panelID, undefined, 'pc-loading');
                break;
        }
    };
</script>

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="page-header">
            <h1>
                <?php echo ($config['table-icon'] ?? ''); ?>
                <?php echo $config['tab-label']; ?>
            </h1>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                    <tr>
                        <?php foreach ($config['display-fields'] as $fieldIndex => $fieldLabel) { ?>
                            <th class="<?php echo "{$current_table}-{$config['display-field-names'][$fieldIndex]}"; ?>" onclick="<?php echo $current_table; ?>GetChildrenRecordsList({
                                    Verb: 'sort',
                                    SortBy: <?php echo $fieldIndex; ?>,
                                    SortDirection: '<?php echo $sort_direction; ?>'
                                });" style="cursor: pointer;">
                                <?php echo $fieldLabel; ?>
                                <?php if ($param['SortBy'] == $fieldIndex) { ?>
                                    <i class="<?php echo $sort_icon; ?> text-warning"></i>
                                <?php } ?>
                            </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                   
