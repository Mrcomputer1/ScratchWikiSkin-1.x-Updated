# Updated 1.x Scratch Wiki Skin (ScratchWikiSkin1)
A skin, based on the original 1.x Scratch Wiki Skin, that has been updated to modern MediaWiki versions (for example, 1.35 and 1.36).

## Note
This is not an official update of the 1.x Scratch Wiki Skin.

## Installation
1. Download the repository [zip](https://github.com/Mrcomputer1/ScratchWikiSkin-1.x-Updated/archive/refs/heads/master.zip).
2. Extract the files to a directory (called `ScratchWikiSkin1`) in your MediaWiki installation's `skins` directory.
3. In your `LocalSettings.php` file add `wfLoadSkin('ScratchWikiSkin1');`.

## Configuration
**$wgSWS1UseCSESearch**: Whether to use Google Custom Search Engine or regular MediaWiki search. (boolean, default: true)

**$wgSWS1CSESearchID**: Google Custom Search Engine ID (string, default: `05211699805409077090:s-ufejuw2ey` (from the original 1.x Scratch Wiki Skin))

**$wgSWS1CSESearchPage**: MediaWiki page to go too (mediawiki page string, default: `Project:Search`)

## Credits
* The creators of the original 1.x Scratch Wiki Skin: for originally creating the 1.x Scratch Wiki Skin. (not sure who specifically created the skin though)
* jvvg: for locating the source code for the original 1.x Scratch Wiki Skin and uploading it to GitHub [here](https://github.com/InternationalScratchWiki/ScratchWikiSkin-1.x)