import { createViteConfig } from "vite-config-factory";

const entries = {
        'css/modularity-quick-links':               './source/sass/modularity-quick-links.scss',
};

export default createViteConfig(entries, {
	outDir: "assets/dist",
	manifestFile: "manifest.json",
});
