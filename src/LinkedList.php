<?php declare(strict_types=1);
require_once ("Node.php");
class LinkedList
{
    /**
     * @var Node|null
     */
    private Node|null $_head;

    /**
     * @param Node $_head
     */
    public function __construct(
        Node $_head
    ) {
        $this->_head = $_head;
    }

    /**
     * @return Node|null
     */
    public function head(): ?Node {
        return $this->_head;
    }

    /**
     * @param Node|string|int $item
     * @return $this
     */
    public function add(Node|string|int $item): self
    {
        $n = $item;
        if (!($item instanceof Node)) {
            $n = new Node($item);
        }
        assert($n instanceof Node);
        if (!$this->newValueIsSameType($n)) {
            throw new InvalidArgumentException("New value is not the same type as previous value");
        }
        if ($this->_head === null) {
            $this->_head = $n;
            return $this;
        }

        $activeNode = $this->_head;
        $previousNode = $this->_head;
        $position = -1;
        $break = false;

        while ($activeNode && !$break) {
            $previousNode = $activeNode;
            $activeNode = $activeNode->getNext();
            $lessThanNext = $activeNode ? $n->compare($activeNode) : null;
            $position = $n->compare($previousNode);
            if ($lessThanNext
                && (
                    ($lessThanNext < 0 && $position >= 0) || ($lessThanNext < 0 && $position < 0)
                )
            ) {
                $break = true;
            }
        }

        if ($position >= 0) {
            $n->setNext($previousNode->getNext());
            $previousNode->setNext($n);
        } else {
            $n->setNext($previousNode);
            $this->_head = $n;
        }

        return $this;
    }

    /**
     * @return Node|null
     */
    public function pop(): ?Node
    {
        if ($this->_head === null) {
            return $this->_head;
        }
        $n = $this->_head;
        $this->_head = $n->getNext();

        return $n;
    }

    /**
     * @return int
     */
    public function size(): int {
        if ($this->_head === null) {
            return 0;
        }
        else {
            $count = 1;
            $n = $this->_head;
            while($n->hasNext()) {
                $count++;
                $n = $n->getNext();
            }
            return $count;
        }
    }

    /**
     * @param LinkedList $list
     * @return $this
     */
    public function merge(LinkedList $list): LinkedList {
        $n = $list->head();
        while ($n->hasNext()) {
            $this->add($n->getValue());
            $n = $n->getNext();
        }

        return $this;
    }

    /**
     * @param string|int $value
     * @return Node|null
     */
    public function get(string|int $value): ?Node {
          $n = $this->_head;
          while($n->hasNext()) {
              if ($n->getValue() === $value) {
                  return $n;
              }
              $n = $n->getNext();
          }

        if ($n && $n->getValue() === $value) {
            return $n;
        }

        return null;
    }

    /**
     * @param string|int $value
     * @return bool
     */
    public function has(string|int $value): bool {
        return $this->get($value) !== null;
    }

    /**
     * @param string|int $value
     * @return void
     */
    public function remove(string|int $value): void {
        $n = $this->_head;
        $pn = $this->_head;
        while($n->hasNext()) {
            if ($n->getValue() === $value) {
                if ($n === $this->_head) {$this->_head = $n->getNext();}
                else {$pn->setNext($n->getNext());}
            }
            $pn = $n;
            $n = $n->getNext();
        }
        if ($n && $n->getValue() === $value) {
            $pn->setNext(null);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string {
        $n = $this->_head;
        $values = [];
        while ($n->getNext()) {
            $values[] = $n->getValue();
            $n = $n->getNext();
        }
        $n && ($values[] = $n->getValue());

        return join(" ", $values);
    }

    /**
     * @param Node $n
     * @return bool
     */
    private function newValueIsSameType(Node $n): bool {
        $nodeType = gettype($n->getValue());
        switch (gettype($this->_head)) {
            case "NULL":
                return true;
            case "object":
                $valType = gettype($this->_head->getValue());
                $nodeType = gettype($n->getValue());
                if ($valType === $nodeType) {
                    return true;
                }
                return false;
            default:
                throw new InvalidArgumentException(`Type {$nodeType} is not supported`);
        }
    }
}
