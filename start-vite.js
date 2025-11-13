import { spawn } from 'child_process';

const vite = spawn('npm', ['run', 'dev'], {
  stdio: 'inherit',
  shell: true,
  windowsHide: true
});

vite.on('error', (error) => {
  console.error(`Vite error: ${error.message}`);
  process.exit(1);
});

vite.on('close', (code) => {
  console.log(`Vite exited with code ${code}`);
  process.exit(code);
});
