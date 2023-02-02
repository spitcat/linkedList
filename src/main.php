<?php declare(strict_types = 1);
require_once ("LinkedList.php");

/**
 * @return void
 */
function main() {
    $linkedList = new LinkedList(new Node("C"));
    $linkedList->add("A");
    $linkedList->add("F");
    $linkedList->add("D");
    $linkedList->add("Z");
    $linkedList->add("B");

    $linkedList->add("sofistikovaný");
    $linkedList->add("ad hoc");
    $linkedList->add("sarkazmus");
    $linkedList->add("anotace");
    $linkedList->add("demagogie");
    $linkedList->add("xenofobie");
    $linkedList->add("žoviální");
    $linkedList->add("logistika");
    $linkedList->add("extravertní");
    $linkedList->add("apriori");
    $linkedList->add("potenciální");
    $linkedList->add("paranoia");
    $linkedList->add("melancholik");
    $linkedList->add("patetický");
    $linkedList->add("asketický");
    $linkedList->add("vágní");
    $linkedList->add("postulát");
    $linkedList->add("stigma");
    $linkedList->add("stigma");
    $linkedList->add("metrosexuál");
    $linkedList->add("cholerik");
    $linkedList->add("precedent");
    $linkedList->add("exaktní");
    $linkedList->add("flegmatik");
    $linkedList->add("filantropie");
    $linkedList->add("kognitivní");

    print($linkedList . "\n\n");


    $linkedListInt = new LinkedList(new Node(99));
    for ($i = 0; $i < 20; $i++) {
        $linkedListInt->add(rand(-1000, 1000));

    }
	print($linkedListInt . "\n\n");
	print($linkedListInt->size() . "\n\n");
    $n = $linkedListInt->pop();
    $n && print($n->getValue() . "\n\n");
    print($linkedListInt . "\n\n");
    print($linkedListInt->size() . "\n\n");

    $linkedListInt2 = new LinkedList(new Node(99));
    for ($i = 0; $i < 20; $i++) {
        $linkedListInt2->add(rand(-1000, 1000));
    }

    $linkedListInt->merge($linkedListInt2);

    print($linkedListInt . "\n\n");

    $n = $linkedList->get("filantropie");
    $n && print($n->getValue() . "\n\n");

    $n = $linkedList->get("filantropieA");
    !$n && print($n . "\n\n");

    $n = $linkedList->get("žoviální");
    $n && print($n->getValue() . "\n\n");

    $linkedList->remove("A");
    $linkedList->remove("apriori");
    $linkedList->remove("žoviální");
    print($linkedList . "\n\n");

    var_dump($linkedList->has("apriori"));
    print("\n\n");
    var_dump($linkedList->has("stigma"));
    print("\n\n");
}

main();
