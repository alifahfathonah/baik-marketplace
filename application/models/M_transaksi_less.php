<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi_less extends CI_Model
{

    var $table         = 'transaksi';
    var $column_order  = array(
        'transaksi.id',
        'transaksi.toko_id',
        'transaksi.pengirim',
        'transaksi.telp_pengirim',
        'transaksi.user_id',
        'transaksi.penerima',
        'transaksi.telp_penerima',
        'transaksi.alamat',
        'transaksi.kelurahan',
        'transaksi.kecamatan',
        'transaksi.kota',
        'transaksi.provinsi',
        'transaksi.status',
        'transaksi.created_date',
        'transaksi.proccess_date',
        'transaksi.shipment_date',
        'transaksi.delivery_date',
        'transaksi.failed_date',
        'transaksi.failed_reason',
    );
    var $column_search = array(
        'transaksi.pengirim',
        'transaksi.telp_pengirim',
        'transaksi.penerima',
        'transaksi.telp_penerima',
        'transaksi.alamat',
    );
    var $order  = array('transaksi.id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select([
            'transaksi.id',
            'transaksi.toko_id',
            'transaksi.pengirim',
            'transaksi.telp_pengirim',
            'transaksi.user_id',
            'transaksi.penerima',
            'transaksi.telp_penerima',
            'transaksi.alamat',
            'transaksi.kelurahan',
            'transaksi.kecamatan',
            'transaksi.kota',
            'transaksi.provinsi',
            'transaksi.status',
            'transaksi.created_date',
            'transaksi.proccess_date',
            'transaksi.shipment_date',
            'transaksi.delivery_date',
            'transaksi.failed_date',
            'transaksi.failed_reason',
        ]);

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                $keyword = $_POST['search']['value'];
                // if (in_array($keyword, ['aktif', 'Aktif', 'AKTIF'])) {
                //     $keyword = TRUE;
                // } elseif (in_array($keyword, ['tidak aktif', 'Tidak Aktif', 'TIDAK AKTIF'])) {
                //     $keyword = FALSE;
                // }
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $keyword);
                } else {
                    $this->db->or_like($item, $keyword);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}

/* End of file M_admins_less.php */
