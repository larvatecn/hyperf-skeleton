<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;
use Swoole\Constant;
use Swoole\Process;

class StopCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    protected ConfigInterface $config;

    public function __construct(ContainerInterface $container, ConfigInterface $config)
    {
        $this->container = $container;
        $this->config = $config;
        parent::__construct('stop');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Stop hyperf servers.');
    }

    public function handle()
    {
        $pidFile = $this->config->get('server.settings.' . Constant::OPTION_PID_FILE);
        if (! is_file($pidFile)) {
            $this->warn('pid file not a file.');
        } else {
            $masterProcessId = file_get_contents($pidFile);
            $this->signal((int) $masterProcessId, SIGKILL);
            @unlink($pidFile);
            $this->info('Stopping server...');
        }
    }

    /**
     * Run the given command.
     *
     * @param string $command
     * @return array
     */
    public function exec(string $command): array
    {
        exec($command, $output);
        return $output;
    }

    /**
     * Send a signal to the given process.
     */
    public function signal(int $processId, int $signal): bool
    {
        if (Process::kill($processId, 0)) {
            return Process::kill($processId, $signal);
        }
        return false;
    }
}
