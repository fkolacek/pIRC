<?php

    define("SOCKET_UNDEFINED", 1);
    define("SOCKET_CREATED", 2);
    define("SOCKET_CONNECTED", 3);

    class pIRCSocket{

        private $remoteHost;
        private $remoteIP;
        private $remotePort;
        private $socket;
        private $state;

        public function __construct($remoteHost, $remotePort){
            $this->socket = NULL;
            $this->state = SOCKET_UNDEFINED;

            $this->remoteIP = gethostbyname($remoteHost);

            $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            $this->state = SOCKET_CREATED;

            if($this->socket === false)
                throw new pIRCException("socket_create failed");

            if(socket_connect($this->socket, $this->remoteIP, $this->remotePort) === false)
                throw new pIRCException("socket_connect failed");

            $this->state = SOCKET_CONNECTED;
        }

        public function __destruct(){
            if(!is_null($this->socket)){
                socket_close($this->socket);
                $this->socket = NULL;
                $this->state = SOCKET_UNDEFINED;
            }
        }

        public function getRemoteHost(){
            return $this->remoteHost;
        }

        public function getRemoteIP(){
            return $this->remoteIP;
        }

        public function getRemotePort(){
            return $this->remotePort;
        }

        public function getState(){
            return $this->state;
        }
    };
