<?php
	var_dump(getFiles('test'));
    var_dump(json_encode(getFiles('test')));
	function getFiles(string $dir): array {
		$files = array_diff(scandir($dir), ['..', '.']);
		$result = [];

		foreach ($files as $file) {
			$path = $dir . '/' . $file;

			if (is_dir($path)) {
				$result = array_merge($result, getFiles($path));
			} else {
				$result[] = $path;
			}
		}

		return $result;
	}

    $array = [1, 2, 5, 8, 10, 50];
    $item = 8;

    function binarySearch(array $array, int $item, int $start = 0, int $end = null): int {
        if ($end === null) {
            $end = count($array) - 1;
        }

        if ($start > $end) {
            throw new LogicException("Item not found");
        }

        $halfIndex = (int) (($start + $end) / 2);

        if ($array[$halfIndex] !== $item) {
            if ($array[$halfIndex] < $item) {
                $start = $halfIndex + 1;
            } else {
                $end = $halfIndex + 1;
            }

            return binarySearch($array, $item, $start, $end);
        }

        return $halfIndex;
    }
    echo "<pre>";
    echo "<h2>". binarySearch($array, $item) ."</h2>";
    echo "<pre>";
