<?php

class ItemCRUDModel extends CI_Model{

	public function get_itemCRUD(){
        if(!empty($this->input->get("search"))){
		    $this->db->or_like('cedula', $this->input->get("search")); 
		    $this->db->like('nombre', $this->input->get("search"));
		    $this->db->or_like('apellido', $this->input->get("search")); 
		    $this->db->or_like('telefono', $this->input->get("search")); 
        }
        $query = $this->db->get("persona");
        return $query->result();
    }

    public function insert_item()
    {    
        $data = array(
            'cedula' => $this->input->post('cedula'),
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'telefono' => $this->input->post('telefono')
        );
        return $this->db->insert('persona', $data);
    }

    public function update_item($id) 
    {
        $data=array(
            'cedula' => $this->input->post('cedula'),
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'telefono' => $this->input->post('telefono')
        );
        if($id==0){
            return $this->db->insert('persona',$data);
        }else{
            $this->db->where('id',$id);
            return $this->db->update('persona',$data);
        }        
    }


    public function find_item($id)
    {
        return $this->db->get_where('persona', array('id' => $id))->row();
    }


    public function delete_item($id)
    {
        return $this->db->delete('persona', array('id' => $id));
    }
}
?>