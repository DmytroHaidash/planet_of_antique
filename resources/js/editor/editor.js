import FroalaEditor from 'froala-editor';

import 'froala-editor/js/plugins/align.min';
import 'froala-editor/js/plugins/colors.min';
import 'froala-editor/js/plugins/draggable.min';
// import 'froala-editor/js/plugins/emoticons.min';
import 'froala-editor/js/plugins/font_family.min';
import 'froala-editor/js/plugins/font_size.min';
import 'froala-editor/js/plugins/fullscreen.min';
import 'froala-editor/js/plugins/image.min';
import 'froala-editor/js/plugins/image_manager.min';
import 'froala-editor/js/plugins/inline_style.min';
import 'froala-editor/js/plugins/inline_style.min';
import 'froala-editor/js/plugins/link.min';
import 'froala-editor/js/plugins/lists.min';
import 'froala-editor/js/plugins/paragraph_format.min';
import 'froala-editor/js/plugins/paragraph_style.min';
import 'froala-editor/js/plugins/quick_insert.min';
import 'froala-editor/js/plugins/quote.min';
import 'froala-editor/js/plugins/url.min';
import 'froala-editor/js/plugins/video.min';
import 'froala-editor/js/plugins/code_view.min';

import 'froala-editor/js/third_party/embedly.min';

import 'froala-editor/js/languages/ru';
import 'froala-editor/js/languages/uk';

import './editor.scss';

const path = location.origin + (/admin/gi.test(location.href) ? '/admin' : '');
const _token = document.querySelector('meta[name="csrf-token"]').content;

new FroalaEditor('.editor', {
  language: document.documentElement.lang,
  charCounterCount: false,
  fileUploadURL: path + '/media/upload',
  imageUploadURL: path + '/media/upload',
  imageManagerLoadURL: path + '/media/all',
  imageManagerDeleteURL: path + '/media/delete',
  imageUploadParams: {_token},
  fileUploadParams: {_token},
  imageManagerDeleteParams: {_token},
  key: "1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe(+%$==",
  attribution: false,
  pastePlain: true,
  paragraphFormat: {
    N: 'Normal',
    H2: 'Heading 2',
    H3: 'Heading 3',
    H4: 'Heading 4'
  }
});
