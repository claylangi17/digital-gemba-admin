import { spawn } from 'child_process';

const queue = spawn('php', ['artisan', 'queue:work', '--tries=3', '--timeout=90'], {
  stdio: 'inherit',
  windowsHide: true
});

queue.on('error', (error) => {
  console.error(`Queue error: ${error.message}`);
  process.exit(1);
});

queue.on('close', (code) => {
  console.log(`Queue exited with code ${code}`);
  process.exit(code);
});
