import { __ } from '@wordpress/i18n';
import { useBlockProps, MediaUpload, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, Button } from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
    const { images, enableParallax } = attributes;

    // Select multiple images
    const selectImages = (media) => {
        setAttributes({ images: media.map(img => img.url) });
    };

    // Show the first image in the editor as a preview
    const previewImage = images?.length ? images[0] : null;

    return (
        <>
            {/* Sidebar Settings */}
            <InspectorControls>
                <PanelBody title={__('Settings', 'random-image-block')}>
                    <ToggleControl
                        label={__('Enable Parallax', 'random-image-block')}
                        checked={enableParallax}
                        onChange={(value) => setAttributes({ enableParallax: value })}
                    />
                </PanelBody>
            </InspectorControls>

            {/* Block Editor */}
            <div 
                {...useBlockProps({ 
                    className: `random-image-block ${enableParallax ? 'parallax' : ''}`,
                    style: { backgroundImage: previewImage ? `url(${previewImage})` : 'none' }
                })}
            >
                <MediaUpload
                    onSelect={selectImages}
                    multiple
                    gallery
                    allowedTypes={['image']}
                    render={({ open }) => (
                        <Button onClick={open} isPrimary>
                            { images?.length ? __('Change Images', 'random-image-block') : __('Select Images', 'random-image-block') }
                        </Button>
                    )}
                />
                <p>{__('Editor preview: First selected image', 'random-image-block')}</p>
            </div>
        </>
    );
}
