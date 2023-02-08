<?php declare(strict_types=1);
require_once ("Node.php");

/**
 * @template T of string|int
 */
class LinkedList
{
    /**
	 * @var Node<T> $_head
     */
    private Node|null $_head;

    /**
     * @param Node<T> $_head
     */
    public function __construct(
        Node $_head
    ) {
        $this->_head = $_head;
    }

    /**
     * @return Node<T>|null
     */
    public function head(): ?Node {
        return $this->_head;
    }

    /**
     * @param Node<T> $previousNode
     * @param Node<T> $newNode
     * @return void
     */
    private function prepend(Node $previousNode, Node $newNode): void {
        if($previousNode === $this->_head) {
            $newNode->setNext($this->_head);
            $this->_head = $newNode;
        }
    }

    /**
     * @param Node<T> $previousNode
     * @param Node<T> $newNode
     * @return void
     */
    private function append(Node $previousNode, Node $newNode): void {
        $newNode->setNext($previousNode->getNext());
        $previousNode->setNext($newNode);
    }

    /**
     * @param Node<T> $item
     * @return $this
     */
    public function add(Node $item): self
    {
        if (!$this->newValueIsSameType($item)) {
            throw new InvalidArgumentException("New value is not the same type as previous value");
        }
        if ($this->_head === null) {
            $this->_head = $item;
            return $this;
        }

        $p = $n = $this->_head;
         while($n !== null) {
            $previous = $item->compare($p);
            $active = $item->compare($n);
            $nextNode = $n->getNext();
            $next = $nextNode ? $item->compare($nextNode) : null;
            if($previous < 0 && $active > $next) {
                $this->prepend($n, $item);
                break;
            } else if ($active > 0 && ($next !== null && $next <= 0)) {
                $this->append($n, $item);
                break;
            } else if ($active > 0 && ($next === null)) {
                $this->append($n, $item);
                break;
            }
            $p = $n;
            $n = $n->getNext();
         }

        return $this;
    }

    /**
     * @return Node<T>|null
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
            while($n) {
                $count++;
                $n = $n->getNext();
            }
            return $count;
        }
    }

    /**
     * @param LinkedList<T> $list
     * @return $this
     */
    public function merge(LinkedList $list): LinkedList {
        $n = $list->head();
        while ($n) {
            $this->add(new Node($n->getValue()));
            $n = $n->getNext();
        }

        return $this;
    }

    /**
     * @param string|int $value
     * @return Node<T>|null
     */
    public function get(string|int $value): ?Node {
        return $this->walk(fn ($p, $n) => $n->getValue() === $value ? $n : null);
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
        $this->walk(function(Node $p, Node $n) use ($value) {
           if($n->getValue() === $value) {
               /**
                * @var Node<T> $nn
                */
               $nn = $n;
               while($nn->getNext() && $nn->getNext()->getValue() === $value) {
                   $nn = $nn->getNext();
               }
               if ($p === $this->_head && $nn->getNext()) {
                   $this->_head = $nn->getNext();
               } else {
                   $p->setNext($nn->getNext());
               }
           }
        });
    }

    /**
     * @return string
     */
    public function __toString(): string {
        $n = $this->_head;
        $values = [];
        while ($n !== null) {
			$values[] = $n->getValue();
			$n = $n->getNext();
		};

        return join(" ", $values);
    }

    /**
     * @param Node<T> $n
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

    /**
     * @return Node<T>|null
     */
    private function walk(callable $callback): ?Node {
        $pn = $n = $this->_head;
        while($n) {
            $result = $callback($pn, $n);
            if ($result) {
                return $result;
            }
            $pn = $n;
            $n = $n->getNext();
        }
        return null;
    }
}
