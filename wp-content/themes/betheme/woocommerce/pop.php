<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;
if ( ! class_exists( 'Product_pop' ) ) :
    class Product_pop
    {
        public function __construct()
        {
            
            add_action( 'wp_enqueue_scripts', array( $this, 'popup_script' ) );
            add_action( 'wp_head', array( $this, 'popup_print_script' ) );
            add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'popup' ) );

        }
        public function popup_script()
        {
            wp_enqueue_style( 'tooltip-css', '//code.jboxcdn.com/0.4.9/jBox.css', '', '1.0' );
            wp_enqueue_script( 'tooltip-js', '//code.jboxcdn.com/0.4.9/jBox.min.js', array( 'jquery'), '1.0', true ); 
        }
        public function popup_print_script()
        {
            ?>
            <script type="text/javascript">
            jQuery(document).ready(function ($) {
                new jBox('Mouse', {
                    dragOver: true,
                    attach: '.type-product',
                    content: $('#popup')
                });
            });
            </script>
            <?php
        }
        public function popup()
        {
            global $post;
            $out  = '<div data-jbox-content="popup-'.$post->ID.'" id="popup" class="popup-wrap ui special popup">';
            $out .= $this->tensanphan();
            $out .= $this->giasanpham();
            $out .= $this->motasanpham();
            $out .= '</div>';
            echo $out;
        }
        private function tensanphan()
        {
            return '<div class="popup-title">'.get_the_title().'</div>';
        }
        private function giasanpham()
        {
            global $product, $post;

            $out  = '<div class="giasanpham">';
            
            $out .= '<span class="masanpham">Mã sản phẩm: '.$product->get_sku().'</span>';

            if ( $product->get_sale_price() ) {

                $out .= '<span class="giagiam">Giá Củ: <strong>'.$product->get_regular_price().'<b>đ</b></strong></span>';
                $out .= '<span class="giasaleoff">Giá Mới: <strong>'.$product->get_sale_price().'<b>đ</b></strong></span>';
            } else {

                $out .= '<span class="giathuong">Giá: <strong>'.$product->get_price().'<b>đ</b></strong></span>';
            }
            $out .= '</div>';
            

            return $out;

        }
        private function motasanpham()
        {
            return '<p class="motasanpham">'.get_the_excerpt().'</p>';
        }
    }
    
endif;
//return
return new Product_pop();