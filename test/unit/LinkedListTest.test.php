<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase {

	 public function testAddLinkedList(): void {
        $list = $this->givenStringLinkedList(new Node("A"));
        $list->add(new Node("D"));
        $this->thenAssertListEquals("A D", $list);
	 }

    public function testMultipleAddLinkedList(): void {
        $list = $this->givenStringLinkedList(new Node("A"));
        $list->add(new Node("D"));
        $list->add(new Node("Z"));
        $list->add(new Node("M"));
        $list->add(new Node("F"));
        $this->thenAssertListEquals("A D F M Z", $list);
    }

    public function testPopLinkedList(): void {
        $list = $this->givenMoreComplexLinkedList();
        $this->thenAssertNodeEquals("ad hoc", $list->pop());
    }

    public function testGetLinkedList(): void {
        $list = $this->givenStringLinkedList(new Node("A"));
        $list->add(new Node("D"));
        $this->thenAssertNodeEquals("D", $list->get("D"));
    }

    public function testRemoveLinkedList(): void {
        $list = $this->givenStringLinkedList(new Node("A"));
        $list->add(new Node("D"));
        $list->remove("A");
        $this->thenAssertListEquals("D", $list);
    }

    public function testMergeLinkedList(): void {
        $list = $this->givenStringLinkedList(new Node("A"));
        $listB = $this->givenMoreComplexLinkedList();

        $this->assertEquals(
            "A ad hoc anotace apriori asketický cholerik demagogie exaktní extravertní filantropie flegmatik kognitivní logistika melancholik metrosexuál paranoia patetický postulát potenciální precedent sarkazmus sofistikovaný stigma stigma vágní xenofobie žoviální",
            $list->merge($listB)->__toString()
        );
    }

    public function testAddIntLinkedList(): void {
        $list = $this->givenIntLinkedList();
        $list->add(new Node(5));
        $this->thenAssertListEquals("5 10", $list);
    }

    public function testAddMultipleIntLinkedList(): void {
        $linkedListInt = $this->givenMoreComplexIntLinkedList();
        $this->thenAssertListEquals("-99 -95 -5 -5 5 5 10 10 100", $linkedListInt);
    }

    public function testRemoveMultipleIntLinkedList(): void {
        $linkedListInt = $this->givenMoreComplexIntLinkedList();
        $linkedListInt->remove(5);
        $this->thenAssertListEquals("-99 -95 -5 -5 10 10 100", $linkedListInt);
        $linkedListInt->remove(-99);
        $this->thenAssertListEquals("-95 -5 -5 10 10 100", $linkedListInt);
        $linkedListInt->remove(100);
        $this->thenAssertListEquals("-95 -5 -5 10 10", $linkedListInt);
    }


     private function givenStringLinkedList(Node $node): LinkedList {
         return new LinkedList($node);
     }

     private function thenAssertListEquals(string $expected, LinkedList $list): void {
         $this->assertEquals($expected, $list->__toString());
     }

    private function thenAssertNodeEquals(string $expected, ?Node $node): void {
        if($node === null) {
            throw new InvalidArgumentException("Node is null");
        }
        $this->assertEquals($expected, $node->getValue());
    }

   private function givenMoreComplexLinkedList(): LinkedList {
         return  (new LinkedList(new Node("sofistikovaný")))
         ->add(new Node("ad hoc"))
         ->add(new Node("sarkazmus"))
         ->add(new Node("anotace"))
         ->add(new Node("demagogie"))
         ->add(new Node("xenofobie"))
         ->add(new Node("žoviální"))
         ->add(new Node("logistika"))
         ->add(new Node("extravertní"))
         ->add(new Node("apriori"))
         ->add(new Node("potenciální"))
         ->add(new Node("paranoia"))
         ->add(new Node("melancholik"))
         ->add(new Node("patetický"))
         ->add(new Node("asketický"))
         ->add(new Node("vágní"))
         ->add(new Node("postulát"))
         ->add(new Node("stigma"))
         ->add(new Node("stigma"))
         ->add(new Node("metrosexuál"))
         ->add(new Node("cholerik"))
         ->add(new Node("precedent"))
         ->add(new Node("exaktní"))
         ->add(new Node("flegmatik"))
         ->add(new Node("filantropie"))
         ->add(new Node("kognitivní"));
     }

     private function givenIntLinkedList(): LinkedList {
        return new LinkedList(new Node(10));
     }

     private function givenMoreComplexIntLinkedList(): LinkedList {
         return $this->givenIntLinkedList()
         ->add(new Node(-99))
         ->add(new Node(-5))
         ->add(new Node(5))
         ->add(new Node(10))
         ->add(new Node(5))
         ->add(new Node(100))
         ->add(new Node(-5))
         ->add(new Node(-95));
     }
}
