import { defineConfig } from "vite"; // Necesario para la configuración de Vite
import laravel from "laravel-vite-plugin";
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build", // Asegúrate de que la salida esté en public/build
    },
});
