<?php 
namespace TestApp\Core;

class JsonList{


    private $list;
    private $newList;

    public function __construct($list="")
    {
        $this->list = $this->decode($list);
        $this->list = is_array($this->list)?$this->list:array();
        $this->newlist = array();
    }

    public function get()
    {
        return $this->list;
    }

    public function add($item=array())
    {        
        array_push($this->list,$item);
    }

    public function update($searchKey="id",$searchMatchValue="1234",$items=array())
    {
        $itemsList = $this->list;
        $updateListItems =array();
        foreach($itemsList as $itemFromList)
        {
            if($itemFromList[$searchKey]==$searchMatchValue)
            {
                //over write current list
                foreach($items as $key => $item )
                {
                    $itemFromList[$key] = $item;
                }  
            }            
            array_push($updateListItems,$itemFromList);             
        }
        return $this->encode($updateListItems);
    }

    public function remove($searchKey="id",$searchMatchValue="1234")
    {
        $itemsList = $this->list;
        $updateListItems =array();        
        foreach($itemsList as $itemFromList)
        {            
            if($itemFromList[$searchKey]!=$searchMatchValue)
            {   //create a new list without the item 
                array_push($updateListItems,$itemFromList);               
            }
        }
        return $this->encode($updateListItems);
    }

    public function search($searchKey="id",$searchMatchValue="1234")
    {
        $itemsList = $this->list;
        foreach($itemsList as $itemFromList)
        {
            if($itemFromList[$searchKey]==$searchMatchValue)
            {
                return true;               
            }
        }
        return false;
    }

    public function searchMultipleKeys($searchKey="id",$searchMatchValue="1234",$extraKey="",$extraKeyValue="")
    {
        $itemsList = $this->list;
        foreach($itemsList as $itemFromList)
        {
            if($itemFromList[$searchKey]==$searchMatchValue && $itemFromList[$extraKey]==$extraKeyValue)
            {
                return true;               
            }
        }
        return false;
    }

    public function count()
    {
        return is_array($this->list)?count($this->list):0;
    }

    public function encode($item=array())
    {
        return json_encode($item);
    }

    public function decode($item="")
    {
        return json_decode($item,true);
    }


    /**
     * Set the value of list
     *
     * @return  self
     */ 
    public function setList($list)
    {
        $this->list = $this->decode($list);
        $this->list = is_array($this->list)?$this->list:array();

        return $this;
    }

    /**
     * Get the value of newList
     */ 
    public function getNewList()
    {
        return $this->encode($this->newList);
    }

    /**
     * Set the value of newList
     *
     * @return  self
     */ 
    public function setNewList($newList)
    {
        $this->newList = $newList;

        return $this;
    }
}

// $items =json_encode(array(
//     array("id"=>12,"name"=>"Dave","state"=>1),
//     array("id"=>13,"name"=>"Jake","state"=>1),
//     array("id"=>14,"name"=>"Hov","state"=>1),
//     array("id"=>15,"name"=>"Mike","state"=>1),
//     array("id"=>16,"name"=>"Receese","state"=>1),
//     array("id"=>17,"name"=>"Luke","state"=>1),
//     array("id"=>18,"name"=>"Wack","state"=>1),
//     array("id"=>19,"name"=>"Susan","state"=>1),
//     array("id"=>20,"name"=>"Jonathan","state"=>1)
// ));


// $list = new jsonList();

// if(!$list->search("id",11))
// {
//    $list->add(array("id"=>11,"name"=>"Reggie","state"=>0));
//    $list->add(array("id"=>18,"name"=>"Wegee","state"=>0));
// }
// echo $list->count();
// echo "\n";

// var_dump($list->update("id",18,array("name"=>"Tembackao","state"=>1)));


// var_dump($list->remove("id",18));

// $notification = new Notification();



// function add($head,$body)
// {
//     //check if head already there 
//     //create new 
//     $notificationUserList = $this->createList();
//     $receiverList = addToList($notificationUserList);
//     $notification->create(array(
//         "head"=> array("value"=>$head),
//         "body"=> array("value"=>$body),
//         "receiver"=> array("value"=>$receiverList),
             

//     ));

//     //fetch details 
//     $receiverList = $notification->getReceivers();
//     $list = new jsonlist($receiverList);
//     $notificationUserList = $this->createList();
//     $finalList = addToList($notificationUserList);
//     $notification->update($finalList);


// }

// function createList(){

//     $results = $this->fetchUser();;
//     $notificationList = array();
//     foreach($results as $result)
//     {
//         if($result['id']!=$currentUserId)
//         {
//             array_push($notificationList,array("id"=>$result['id'],"state"=>1));
//         }   
//     }
//     return $notificationList;
// }


// function addToList($notificationUserList)
// {
//     $list = new jsonlist();
//     //add list to existing list
//     foreach($notificationUserList as $notificationListItem)
//     {
//         if(!$list->search("id",$notificationListItem["id"]))
//             {
//                 $list->add($notificationListItem);
//             }
//     }
//     return $list->get();
// }

 

