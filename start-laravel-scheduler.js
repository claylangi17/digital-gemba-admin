import { spawn } from 'child_process';

const scheduler = spawn('php', ['artisan', 'schedule:work'], {
    stdio: 'inherit',
    windowsHide: true
});

scheduler.on('error', (error) => {
    console.error(`Scheduler error: ${error.message}`);
    process.exit(1);
});

scheduler.on('close', (code) => {
    console.log(`Scheduler exited with code ${code}`);
    process.exit(code);
});
