<?php 

	//class que auxilia na conexao com o banco de dados 

	class sql extends PDO{
		// esta class extende tudo da class pdo que é nativa do php , 

		private $conn;
		
		/*	Metodo construtor
			O método construtor de uma classe sempre é executando quando um objeto da classe é instanciado. É um tipo especial de função do PHP. Normalmente o programador utiliza o método construtor para inicializar os atributos de um objeto, como por exemplo: Estabelecer conexão com um banco de dados, abertura de um arquivo que será utilizado para escrita de log, etc.	

		*/
		public function __construct(){    // metodo construtor que faz conexao ao banco
			$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
		
			}


		// Imagine que eu tenha outros metodos que precise fazer isto novamente / assim criamos outro metodo setparams: que possamos reutilizalos ao inves de deixalo na query

		private function setParams($statment, $paramters = array()){
			 //foreach percorre minha linha de tabela
			 foreach ($paramters as $key => $value) {

			 	 	
			 	$this->setParam($key,$value);
			 }

		}

		
		private function setParam($statment, $key, $value){

			$statment->bindParam($key,$value);//associando paramentro ao comando // segurança contra sql injection:bindparam
		}	

		
			//metodo que executa comando no banco de dados\
			// rowquery query bruta q sera tratada 
		public function query($rawQuery, $params  = array()){
			/* metodo prepare()
			 utiliza prepared statements uma fez feita a consulta ela é otimizada pelo banco e pode ser executada N vezes o que muda são os argumentos, seu uso evita problema com sql injection desde que usado corretamente.
			*/
			$stmt = $this->conn->prepare($rawQuery);
			
			$this->setParams($stmt,$params);
			
			$stmt->execute();
			return $stmt;
			}


		// metodo para fazer select no banco
			// recurso novo do php 7 que informa que estamos recebendo em em return um array ::array
		public function select($rawquery/*query bruta*/,$params = array()){

			$stmt = $this->query($rawquery,$params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC /* Funcçaõ PDO que traz apenas dados associativos*/);

		}			

	}
 ?>