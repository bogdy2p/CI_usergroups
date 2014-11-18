<?php

class Message_model extends CI_Model {

  //Constructor function for class Message_model.
  function __construct() {
    parent::__construct();
  }

  function create($message, $from, $to, $attachment) {
    $data = array(
      'content' => $message,
      'sent_from' => $from,
      'sent_to' => $to,
      'status' => 0,
      'attachment_id' => $attachment,
      'times_viewed' => 0,
    );
    $created = $this->db->insert('private_message', $data);
    return $created;
  }

  function read() {
    $this->db->select('*');
    $this->db->from('private_message');
    $this->db->order_by('id', 'DESC');
    $result = $this->db->get();
    $message_array = array();
    foreach ($result->result() as $message) {
      $message_array[] = $message;
    }
    return $message_array;
  }

  function update() {
    
  }

  function delete($id) {
    $this->db->from('private_message');
    $this->db->where('id', $id);
    //AICI TREBUIE GANDIT PUTINA LOGICA MAI INTERESANTA
    //USERUL POATE STERGE DOAR MESAJELE PROPRII , NU SI MESAJELE ALTOR USERI
    //USERUL CARE TRIMITE MESAJUL , TREBUIE SA POATA SA IL STEARGA MAXIM DUPA 5 MINUTE DE LA POSTARE
    $this->db->delete('private_message');
  }

  function delete_all_messages_for_user($user_id) {
    $this->db->from('private_message');
    //AICI TREBUIE GANDIT PUTINA LOGICA MAI INTERESANTA
    //USERUL CARE TRIMITE MESAJUL , TREBUIE SA POATA SA IL STEARGA MAXIM DUPA 5 MINUTE DE LA POSTARE
    //$this->db->where('user_id',$id);
    $this->db->delete('private_message');
  }

}
