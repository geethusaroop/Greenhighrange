<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Db_controller extends MY_Controller
{
	public $page  = 'Dashboard';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
	}
	public function createTable()
	{
		$this->load->dbforge();
		$fields = [
			'cat_id' => [
				'type' => 'INT',
				'constraint' => '11',
				'auto_increment' => TRUE
			],
		
            'cat_name' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'default' => NULL,
			],
          
			'cat_status' => [
				'type' => 'INT',
				'constraint' => '11',
			],
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('cat_id', TRUE);
		//edit here table name
	//$query = $this->dbforge->create_table('tbl_category');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function modifyTable()
	{
		$this->load->dbforge();
		$fields = [
			'scheme_status' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],	
		];
	 	//$query = $this->dbforge->modify_column('tbl_scheme', $fields);
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		} 
	}
	public function alterTable()
	{
		$this->load->dbforge();
		$fields = [
			
				'purchase_ven_discount' => [
					'type' => 'FLOAT',
					'default' => NULL,
				],
				
		];
		//$query = $this->dbforge->add_column('tbl_mara_purchase',$fields);  //uncomment this line
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		} 
	}
	public function truncateTable()
	{
		$this->load->dbforge();
		//$query=$this->db->truncate('tbl_purchase');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function dropTable()
	{
		$this->load->dbforge();
		//$query = $this->dbforge->drop_table('ntbl_stock_incoming');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function mydb_backup()
	{
		$this->load->dbutil();
		$prefs = array(
			'format'      => 'zip',
			'filename'    => 'my_db_backup.sql'
		);
		$backup = &$this->dbutil->backup($prefs);
		$db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
		/* $save = 'pathtobkfolder/'.$db_name;
$this->load->helper('file');
write_file($save, $backup);  */
		$this->load->helper('download');
		force_download($db_name, $backup);
	}
	public function run_sql(){
		$sql="ALTER TABLE `tbl_purchase` ADD `purchase_branch_id_fk` INT NOT NULL AFTER `purchase_id`";

		/* $sql="CREATE TABLE IF NOT EXISTS `tbl_master_branch_sale` (
			`sale_id` int(11) NOT NULL AUTO_INCREMENT,
			`sale_branch_id_fk` int(11) NOT NULL,
			`product_id_fk` int(11) NOT NULL,
			`finyear` varchar(11) DEFAULT NULL,
			`invoice_number` varchar(50) DEFAULT NULL,
			`auto_invoice` varchar(255) DEFAULT NULL,
			`sale_mop` varchar(50) DEFAULT NULL,
			`sale_taxmode` varchar(50) DEFAULT NULL,
			`sale_hsn` int(11) DEFAULT NULL,
			`sale_quantity` bigint(20) DEFAULT NULL,
			`sale_price` float DEFAULT NULL,
			`discount_price` float DEFAULT NULL,
			`total_price` float DEFAULT NULL,
			`taxamount` float DEFAULT NULL,
			`sale_cgst` float DEFAULT NULL,
			`sale_cgstamt` float DEFAULT NULL,
			`sale_sgst` float DEFAULT NULL,
			`sale_sgstamt` float DEFAULT NULL,
			`sale_igst` float DEFAULT NULL,
			`sale_igstamt` float DEFAULT NULL,
			`sale_netamt` float DEFAULT NULL,
			`sale_date` date DEFAULT NULL,
			`sale_staff` int(11) DEFAULT NULL,
			`return_qty` int(11) DEFAULT NULL,
			`return_price` int(11) DEFAULT NULL,
			`return_date` date DEFAULT NULL,
			`computer_id` varchar(50) DEFAULT NULL,
			`tax_id_fk` int(11) DEFAULT NULL,
			`sale_status` int(11) DEFAULT NULL,
			`sale_shareholder_discount` float NOT NULL,
			`sale_discount` float NOT NULL,
			`sale_old_balance` float NOT NULL,
			`sale_new_balance` float NOT NULL,
			`sale_paid_amount` float DEFAULT NULL,
			`product_code` varchar(100) DEFAULT NULL,
			`invoice` int(11) NOT NULL,
			PRIMARY KEY (`sale_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1"; */
		//$sql="TRUNCATE TABLE `tbl_branch_transfer`";
		$query = $this->db->query($sql);
		 if($query){ echo "Success"; }else{ echo "Failed"; } die;
	}
}
