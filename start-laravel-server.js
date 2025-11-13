import { spawn } from 'child_process';

const server = spawn('php', ['artisan', 'serve', '--host=0.0.0.0', '--port=8000'], {
  stdio: 'inherit',
  windowsHide: true
});

server.on('error', (error) => {
  console.error(`Server error: ${error.message}`);
  process.exit(1);
});

server.on('close', (code) => {
  console.log(`Server exited with code ${code}`);
  process.exit(code);
});
