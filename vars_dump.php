//const vars_dump_mode = 1;

function vars_dump(mixed $variable): void
{
	$c = [
		'reset'          => "\033[0m",
		'black'          => "\033[0;30m",
		'red'            => "\033[0;31m",
		'green'          => "\033[0;32m",
		'yellow'         => "\033[0;33m",
		'blue'           => "\033[0;34m",
		'magenta'        => "\033[0;35m",
		'cyan'           => "\033[0;36m",
		'white'          => "\033[0;37m",
		'bright_black'   => "\033[1;30m",
		'bright_red'     => "\033[1;31m",
		'bright_green'   => "\033[1;32m",
		'bright_yellow'  => "\033[1;33m",
		'bright_blue'    => "\033[1;34m",
		'bright_magenta' => "\033[1;35m",
		'bright_cyan'    => "\033[1;36m",
		'bright_white'   => "\033[1;37m",
	];


	if (defined('vars_dump_mode') && 1 == vars_dump_mode) {
		ob_start();
		var_dump($variable);
		$output = ob_get_clean();
		$output = preg_replace('/(int|float|string|bool)\((\d+|\".*\")\)/', $c['cyan'] . '$0' . $c['reset'], $output);
		$output = preg_replace('/(array|object|{|})/', $c['bright_magenta'] . '$0' . $c['reset'], $output);
		$output = preg_replace('/\[(\".*\")\]/', $c['bright_green'] . '$0' . $c['reset'], $output);
		$output = preg_replace('/(=>)/', $c['bright_cyan'] . '$0' . $c['reset'], $output);
	}
	else {
		$output = var_export($variable, true);
		$output = preg_replace('/(\'.*?\'\s*)(\=>)(.*)/', "{$c['bright_yellow']}\$1{$c['magenta']}\$2{$c['cyan']}\$3{$c['reset']}", $output);
		$output = preg_replace('/(array|object)/', $c['bright_blue'] . '$0' . $c['reset'], $output);
	}

	echo $output;
}
