import { createViteConfig } from "vite-config-factory";

const entries = {
        'css/modularity-quick-links':               './source/sass/modularity-quick-links.scss',
        'js/modularity-quick-links':                './source/js/modularity-quick-links.js',
};

export default createViteConfig(entries, {
	outDir: "assets/dist",
	manifestFile: "manifest.json",
});
