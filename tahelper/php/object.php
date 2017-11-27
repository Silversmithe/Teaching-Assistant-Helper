<?PHP
    /* Question Answer Object */
    class QAObject{
        // properties
        public $id;
        public $timestamp;
        public $name;
        public $question;
        public $answer;
        public $answered;
        
        // methods
        function __construct($i, $t, $n, $q, $a){
            $this->id = $i;            
            $this->timestamp = $t;
            $this->name = $n;
            $this->question = $q;
            $this->answer = $a;
            $this->answered = !is_null($this->answer);
        }
        
        function setAnswer($a){
            $this->answer = $a;
            $this->answer = !is_null($this->answer);
        }
    }

    /* Announcement Object */
    class AObject{
        // properties
        public $id;
        public $announcement;
        
        // methods
        function __construct($i, $a){
            $this->id = $i;
            $this->announcement = $a;
        }
    }

?>
