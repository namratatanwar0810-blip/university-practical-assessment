import { store } from '@wordpress/interactivity';

const { actions } = store(
    'university/program-filter',
    {
        actions: {
            filterPrograms( event ) {

                event.preventDefault();

                console.log( 'FILTER JS WORKING' );

                const button = event.currentTarget;
                const filter = button.dataset.filter;

                const cards = document.querySelectorAll(
                    '.program-card'
                );

                cards.forEach( ( card ) => {

                    const type = card.dataset.programType;

                    card.style.display =
                        filter === 'all' || type === filter
                            ? ''
                            : 'none';
                });

                const sections = document.querySelectorAll(
                    '.program-type-section'
                );

                sections.forEach( ( section ) => {

                    const heading = section.querySelector(
                        '.program-type-heading'
                    );

                    if ( ! heading ) {
                        return;
                    }

                    const text = heading.textContent
                        .trim()
                        .toLowerCase();

                    if ( filter === 'all' ) {
                        section.style.display = '';
                    } else if (
                        filter === 'undergraduate' &&
                        text.includes( 'undergraduate' )
                    ) {
                        section.style.display = '';
                    } else if (
                        filter === 'postgraduate' &&
                        text.includes( 'postgraduate' )
                    ) {
                        section.style.display = '';
                    } else {
                        section.style.display = 'none';
                    }
                });

                let url = '/programmes/';

                if ( filter === 'undergraduate' ) {
                    url = '/programmes/?program_type=undergraduate';
                }

                if ( filter === 'postgraduate' ) {
                    url = '/programmes/?program_type=postgraduate';
                }

                window.history.pushState(
                    {},
                    '',
                    url
                );

                document
                    .querySelectorAll( '.program-filter-button' )
                    .forEach( ( filterButton ) => {

                        filterButton.classList.toggle(
                            'active',
                            filterButton.dataset.filter === filter
                        );
                    });
            },
        },
    }
);

console.log( 'PROGRAM FILTER JS LOADED' );