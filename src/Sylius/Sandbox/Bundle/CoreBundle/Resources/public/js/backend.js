/*
 * This file is part of the Sylius sandbox application.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
(function ( $ ) {
    $(document).ready(function() {
        $("a.confirmer").each(function () {
            $(this).data('confirmerLink', this.href);
            $(this).click(function (e) {
                e.preventDefault();
                $("#confirmer-modal").modal('show');
                $("#confirmer-modal p.confirmer-modal-question").html($(this).data('confirmerQuestion'));
                $("#confirmer-modal a.confirmer-modal-confirm").attr('href', $(this).data('confirmerLink'));
            });
        });

        if ($("#sylius-sales-order-items").length > 0) {
            $("#sylius-sales-order-items-adder").click(function () {
                addOrderItemForm();
            });
            if ($("#sylius-sales-order-items tbody").children().length === 1) {
                addOrderItemForm();
            }
        }

        if ($("#sylius_assortment_product_images").length > 0) {
            $("#sylius-assortment-product-image-adder").click(function () {
                addImageForm();
            });

            if ($("#sylius_assortment_product_images").children().length === 0) {
                addImageForm();
            }
        }
    });

    function addOrderItemForm() {
        var collectionHolder = $("#sylius-sales-order-items tbody");
        var prototype = $("#sylius-sales-order-items").attr('data-prototype');
        var newOrderItem = prototype.replace(/__name__/g, collectionHolder.children().length - 1);
        newOrderItem = newOrderItem.replace(/__id__/g, collectionHolder.children().length - 1);
        newOrderItem = newOrderItem.replace(/__position__/g, collectionHolder.children().length);
        $("#sylius-sales-order-items tbody tr:last").before(newOrderItem);
    }
    function addImageForm() {
        var collectionHolder = $("#sylius_assortment_product_images");
        var prototype = $(collectionHolder
            .attr('data-prototype')
            .replace(/__name__/g, collectionHolder.children().length)
        );
        prototype
            .find('input')
            .addClass('file-hide')
            .after('<span class="btn large file-overlay">upload image</span>')
        ;
        collectionHolder.append(prototype.find('div.controls').html());
    }
})( jQuery );
