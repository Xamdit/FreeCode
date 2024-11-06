module.exports = {
    apps: [{
        name: 'cv9bet.com',
        exec_mode: 'fork',
        instances: '1', // Or a numbder of instances
        script: 'member/server-backend.js',
        args: '',
        env: {
            NODE_ENV: "production",
        }
    }]
}