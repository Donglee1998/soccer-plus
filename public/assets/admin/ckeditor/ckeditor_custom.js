function MinHeightPlugin(editor) {
  this.editor = editor;
}

MinHeightPlugin.prototype.init = function() {
    this.editor.ui.view.editable.extendTemplate({
        attributes: {
            style: {
                minHeight: '200px'
            }
        }
    });
};

var myEditor;

ClassicEditor.builtinPlugins.push(MinHeightPlugin);

function createEditor (elementId) {
    return ClassicEditor
        .create( document.querySelector( `${elementId}` ), {
            language: 'ja',
            ckfinder: {
                uploadUrl: '/admin/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
                options: {
                    resourceType: 'Images'
                }
            },
            link: {
                // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
                //addTargetToExternalLinks: true,
                decorators: {
                    openInNewTab: {
                        mode: 'manual',
                        label: '新しいタブで開く',
                        //defaultValue: true,
                        attributes: {
                            target: '_blank',
                            rel: 'noopener noreferrer'
                        }
                    },
                }
            },
            mediaEmbed: {
                previewsInData: true,
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    // { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'headline1' },
                    // { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'headline2' },
                    // { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'headline3' },
                    {
                        model: 'heading1Custom',
                        view: {
                            name: 'h1',
                            classes: 'headline4'
                        },
                        title: '見出し1',
                        converterPriority: 'high'
                    },
                    {
                        model: 'heading2Custom',
                        view: {
                            name: 'h2',
                            classes: 'ttlCmn02'
                        },
                        title: '見出し2',
                        converterPriority: 'high'
                    },
                    {
                        model: 'heading3Custom',
                        view: {
                            name: 'h3',
                            classes: 'headline3'
                        },
                        title: '見出し3',
                        converterPriority: 'high'
                    }
                ]
            },
            htmlSupport: {
              allow: [
                  {
                      name: /.*/,
                      attributes: true,
                      classes: true,
                      styles: true
                  }
              ]
            }
        })

        .then(value => {
            if (`${elementId}` == '[name="data[editor]"]') {
                myEditor = value;
            }
        })

        .catch( error => {
            console.error( error );
        });
}
