var listaimgs_itemList = [
    {url: "http://static.flickr.com/66/199481236_dc98b5abb3_s.jpg", title: "Flower1"},
    {url: "http://static.flickr.com/75/199481072_b4a0d09597_s.jpg", title: "Flower2"},
    {url: "http://static.flickr.com/57/199481087_33ae73a8de_s.jpg", title: "Flower3"},
    {url: "http://static.flickr.com/77/199481108_4359e6b971_s.jpg", title: "Flower4"},
    {url: "http://static.flickr.com/58/199481143_3c148d9dd3_s.jpg", title: "Flower5"},
    {url: "http://static.flickr.com/72/199481203_ad4cdcf109_s.jpg", title: "Flower6"},
    {url: "http://static.flickr.com/58/199481218_264ce20da0_s.jpg", title: "Flower7"},
    {url: "http://static.flickr.com/69/199481255_fdfe885f87_s.jpg", title: "Flower8"},
    {url: "http://static.flickr.com/60/199480111_87d4cb3e38_s.jpg", title: "Flower9"},
    {url: "http://static.flickr.com/70/229228324_08223b70fa_s.jpg", title: "Flower10"}
];

function mycarousel_itemLoadCallback(carousel, state)
{
    for (var i = carousel.first; i <= carousel.last; i++) {
        if (carousel.has(i)) {
            continue;
        }

        if (i > listaimgs_itemList.length) {
            break;
        }

        carousel.add(i, mycarousel_getItemHTML(listaimgs_itemList[i-1]));
    }
};

/**
 * Item html creation helper.
 */
function mycarousel_getItemHTML(item)
{
    return '<img src="' + item.url + '" width="75" height="75" alt="' + item.url + '" />';
};

function iniciarListaDinamica(onde) {
    jQuery(onde).jcarousel({
        size: listaimgs_itemList.length,
        itemLoadCallback: {onBeforeAnimation: listaimgs_itemLoadCallback}
    });
}