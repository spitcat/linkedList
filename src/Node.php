<?php declare(strict_types=1);

/**
 * @template T of int|string
 */
class Node {
	/**
	 * @template T of int|string
	 * @var T of int|string
	 */
	private string|int $value;
	/**
	 * @var Node<T>|null
	 */
	private Node|null $next;

	/**
	 * @param T $value
	 * @param Node<T>|null $next
	 */
	public function __construct(
		string|int $value,
		Node|null $next = null
	) {
		$this->value = $value;
		$this->next = $next;
	}

	/**
	 * @return T
	 */
	public function getValue(): int|string {
		return $this->value;
	}

	/**
	 * @return Node<T>|null
	 */
	public function getNext(): ?Node {
		return $this->next;
	}

    /**
     * @return bool
     */
	public function hasNext(): bool {
		return $this->next !== null;
	}

    /**
     * @param Node<T>|null $n
     * @return void
     */
	public function setNext(?Node $n): void	 {
		 $this->next = $n;
	}

    /**
	 *
     * @param Node<T> $n
     * @return int
     */
	public function compare(Node $n): int {
		if (is_string($this->value) && is_string($n->getValue())) {
			return strcmp($this->value, $n->getValue());
		}
		return $this->value >= $n->getValue() ? 1 : -1;
	}
}
