module.exports = {
  apps: [
    {
      name: 'gemba-admin-laravel-server',
      script: './start-laravel-server.js',
      interpreter: 'node',
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '500M',
      windowsHide: true,
      env: {
        APP_ENV: 'local',
      },
      error_file: './storage/logs/pm2-server-error.log',
      out_file: './storage/logs/pm2-server-out.log',
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z',
    },
    {
      name: 'gemba-admin-laravel-queue',
      script: './start-laravel-queue.js',
      interpreter: 'node',
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '300M',
      windowsHide: true,
      env: {
        APP_ENV: 'local',
      },
      error_file: './storage/logs/pm2-queue-error.log',
      out_file: './storage/logs/pm2-queue-out.log',
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z',
    },
    {
      name: 'gemba-admin-laravel-scheduler',
      script: './start-laravel-scheduler.js',
      interpreter: 'node',
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '300M',
      windowsHide: true,
      env: {
        APP_ENV: 'local',
      },
      error_file: './storage/logs/pm2-scheduler-error.log',
      out_file: './storage/logs/pm2-scheduler-out.log',
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z',
    },

  ],
};
