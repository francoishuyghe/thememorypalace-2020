import 'isotope-layout/dist/isotope.pkgd.min'
import episodes from './episodes-functions';

export default {
  init() {
    // JavaScript to be fired on the about us page
    console.log('Episodes page');
    episodes.tagsSetup();
  },
  finalize() {
    episodes.isotopeSetup();
  },
};
