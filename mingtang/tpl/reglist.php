<?php
/**
create table wp_mingtang_reg(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `real_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reg_type` tinyint(1) NOT NULL default 1,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/
$reg_types = array(
    1 => '参观画展',
    2 => '体验课',
);
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Xy_reg_List_Table extends WP_List_Table
{
    function __construct()
    {
        global $page;

        parent::__construct(array(
            // 'singular' => 'reg',
            'plural' => 'regs',
        ));
    }

    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    // function column_name($item)
    // {
    //     $actions = array(
    //         'edit' => sprintf('<a href="?page=reg_form&id=%s">%s</a>', $item['id'], '编辑'),
    //         'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], '删除'),
    //     );

    //     return sprintf('%s %s',
    //         $item['name'],
    //         $this->row_actions($actions)
    //     );
    // }

    function get_columns()
    {
        $columns = array(
            'real_name' => '姓名',
            'email' => '邮箱',
            'reg_type' => '预约类型',
            'create_time' => '报名时间',
        );
        return $columns;
    }

    // function get_bulk_actions()
    // {
    //     $actions = array(
    //         'delete' => '删除'
    //     );
    //     return $actions;
    // }

    function process_bulk_action()
    {
    //     global $wpdb;
    //     $table_name = $wpdb->prefix . 'mingtang_reg';

    //     if ('delete' === $this->current_action()) {
    //         $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
    //         if (is_array($ids)) $ids = implode(',', $ids);

    //         if (!empty($ids)) {
    //             $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
    //         }
    //     }
    }

    function prepare_items()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mingtang_reg';

        $per_page = 10;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->process_bulk_action();

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

        $where = '';
        if (!empty($_REQUEST['regq'])) {
            $regq = '%' . $wpdb->esc_like($_REQUEST['regq']) . '%';
            $where = $wpdb->prepare("`real_name` like %s or `email` like %s", $regq, $regq);
        }
        if (!empty($_REQUEST['regtype'])) {
            if ($where) {
                $where .= ' AND ';
            }
            $where .= $wpdb->prepare("`reg_type` = %s", $_REQUEST['regtype']);
        }
        if ($where) {
            $where = ' WHERE ' . $where;
        }
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name" . $where);
        $this->items = $wpdb->get_results("SELECT * FROM $table_name" . $where . " ORDER BY $orderby $order LIMIT $per_page OFFSET " . $per_page * $paged, ARRAY_A);
        if (!empty($this->items)) {
            global $reg_types;
            foreach ($this->items as $kk => $vv) {
                $reg_type = $vv['reg_type'];
                $this->items[$kk]['reg_type'] = $reg_types[$reg_type];
                $this->items[$kk]['create_time'] = date('Y-m-d H:i:s', $vv['create_time']);
            }
        }

        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page)
        ));
    }
}

function xy_reg_admin_menu()
{
    add_menu_page('预约报名', '预约报名', 'edit_pages', 'reg_list', 'xy_reg_list_page_handler');
}

add_action('admin_menu', 'xy_reg_admin_menu');

function xy_reg_list_page_handler()
{
    global $wpdb;

    $table = new Xy_reg_List_Table();
    $table->prepare_items();

    $message = '';
?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <?php echo $message; ?>

    <form id="reg-table" method="GET">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <p class="search-box">
            <label class="screen-reader-text" for="post-search-input">搜索:</label>
            <select name="regtype">
                <option value="0">All</option>
                <?php global $reg_types;?>
                <?php foreach ($reg_types as $type_key => $type_value) { ?>
                    <option value="<?php echo $type_key;?>"<?php echo $_REQUEST['regtype'] ? ' selected="selected"' : ''; ?>><?php echo $type_value;?></option>
                <?php } ?>
            </select>
            <input type="text" name="regq" value="<?php echo isset($_REQUEST['regq']) ? $_REQUEST['regq'] : ''; ?>">
            <input type="submit" class="button" value="搜索">
        </p>
        <?php $table->display() ?>
    </form>

</div>
<?php
}
