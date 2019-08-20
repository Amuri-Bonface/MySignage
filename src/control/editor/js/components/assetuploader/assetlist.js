var $ = require('jquery');
var util = require('ls-util');

/*
*  Asset list thumbnail template. 'slide' is the slide
*  object to use and 'name' is the asset name.
*/

const asset_thumb_template = (name, thumb_uri) => `
<div class="thumb">
	<div class="thumb-inner default-border">
		<div class="thumb-img-wrapper">
			<img src="${thumb_uri}"></img>
		</div>
		<div class="thumb-label-wrapper">
			<div class="thumb-rm-wrapper">
				<button class="btn btn-danger small-btn btn-remove"
						type="button">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="thumb-label">${name}</div>
		</div>
	</div>
</div>
`;

class AssetList {
	constructor(container) {
		this.container = container;
		this.slide = null;
	}

	show(slide) {
		/*
		*  Show the asset list for 'slide'.
		*/
		this.slide = slide;
		this.update();
	}

	hide() {
		/*
		*  Hide the asset list.
		*/
		this.slide = null;
		this.update();
	}

	update() {
		/*
		*  Update the asset list content.
		*/
		$(this.container).html('');
		if (this.slide == null) { return; }

		for (let a of this.slide.get('assets')) {
			let thumb_uri = null;
			let html = null;

			/*
			*  Use the asset thumbnail if it exists and a placeholder
			*  icon otherwise.
			*/
			if (this.slide.has_thumb(a.filename)) {
				thumb_uri = this.slide.get_asset_thumb_uri(a.filename);
			} else {
				thumb_uri = util.fa_svg_uri('solid', 'image');
			}

			html = $(asset_thumb_template(
				a.filename,
				thumb_uri
			));
			$(this.container).append(html);

			// Attach event listeners for the select and remove actions.
			html.on('click', () => {
				this.trigger(
					'select',
					{ name: a.filename }
				);
			});
			html.find('.btn-remove').on('click', e => {
				this.trigger(
					'remove',
					{ name: a.filename }
				);
				e.preventDefault();
			})
		}
	}

	trigger(name, data) {
		$(this.container).trigger(`component.assetlist.${name}`, data);
	}
}
exports.AssetList = AssetList;
