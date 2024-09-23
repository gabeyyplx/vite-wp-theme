import liveReload from 'vite-plugin-live-reload'

export default {
  build: {
    manifest: true,
    cssCodeSplit: false,
    rollupOptions: {
      input: {
        main: './src/main.js',
      },
    },
  },
  plugins: [liveReload('**/*.php')],
}
