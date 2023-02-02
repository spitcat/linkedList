<?php declare(strict_types=1);

class Node {
	private string|int $value;
	private Node|null $next;
	public function __construct(
		string|int $value,
		Node|null $next = null
	) {
		$this->value = $value;
		$this->next = $next;
	}

	/**
	 * @return int|string
	 */
	public function getValue(): int|string {
		return $this->value;
	}

	/**
	 * @return Node|null
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
     * @param Node|null $n
     * @return void
     */
	public function setNext(?Node $n): void	 {
		 $this->next = $n;
	}

    /**
     * @param Node $n
     * @return int
     */
	public function compare(Node $n): int {
		if (is_string($this->value) && is_string($n->getValue())) {
			return strcmp($this->value, $n->getValue());
		}
		return $this->value >= $n->getValue() ? 1 : -1;
	}
}
