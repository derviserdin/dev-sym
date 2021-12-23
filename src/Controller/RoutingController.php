<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RoutingController extends AbstractController
{
    /**
     * /**
     * @Route({
     *      "en": "/about",
     *      "tr": "/hakkinda"
     *     }, name="about")
     * @return Response
     */
    public function hakkinda()
    {
        return new JsonResponse(['Message' => 'Hakkında Sayfası']);
    }


    # \d+ ile sadece bu get methoduna integer bir değeri kabul etmemiz mümkün olur
    # Simple routingde ilk  ihtiyacı karşılayan her zaman much olur
    /**
     * @Route("/blog/{page}" ,name="blog_listele" , requirements={"page"="\d+"})
     * @return Response
     */
    public function listele($page)
    {
        return new Response(content: "listeleme 12 :" . $page);
    }

    # \d+ ile farklı bir kullanım

    /**
     * @Route("/blog/{page<\d+>}" ,name="blog_listele_3")
     * @return Response
     */
    public function listeleBlog($page)
    {
        return new Response(content: "Sayfa :" . $page);
    }


    /**
     * @Route("/blog/{postSlug}" ,name="blog_listele_2")
     * @return Response
     */
    public function listeleWithSlug($postSlug)
    {
        return new Response(content: "Post Slug :" . $postSlug);
    }


    #bu örnekte _locale ile istediğimi urllleri kabul etme şartını gördüm

    /**
     * @Route("/routing/hello/{_locale}", defaults={"_locale"="tr"} , requirements={"_locale"="en|tr"})
     * @return Response
     */
    public function helloRouting($_locale)
    {
        return new Response(content: "Local is :" . $_locale);
    }

    #sadece istediğimiz methodları set etmemize  yarar

    /**
     * @Route("/api/post/{id}", methods={"GET" , "HEAD"})
     * @return Response
     */
    public function showPage($id)
    {
        return new JsonResponse(['message' => $id]);
    }


    /**
     * @Route("/posts/{page}", name="post_listele" , requirements={"page"="\d+"})
     * @return JsonResponse
     */
    public function postListeleme($page = 1)
    {

        return new JsonResponse(['message' => $page]);
    }

    #{page<\d+>?2} soru işaretinden sonra ki değer default olarak gelecek sayfa numarasıdir.

    /**
     * @Route("/post-listele/{page<\d+>?2}", name="post_listele_yeni")
     * @return JsonResponse
     */
    public function postListeleme2($page)
    {

        return new JsonResponse(['message' => $page]);
    }


    /**
     * @Route(
     *     "/makaleler/{_locale}/{yil}/{slug}.{_format}",
     *     defaults={"_format":"html"},
     *     requirements={
     *          "_locale": "en|tr",
     *          "_format": "html|json",
     *          "yil":"\d+"
     *  }
     * )
     * @return JsonResponse
     */
    public function showMakale($_locale, $yil, $slug, $_format)
    {
        return new JsonResponse(['message' => implode("--", [
            $_locale, $yil, $slug, $_format,
        ])]);
    }

    /**
     * @Route("/generate-url")
     * @return JsonResponse
     */
    public function urlUret()
    {
        $url=$this->generateUrl("app_routing_showmakale",[
            '_locale' => 'en',
            '_format' => 'html',
            'yil'=>1990,
            'slug'=>'Kaliteli-kod-nasıl-yazılır'
        ]);
        return new JsonResponse(['url' => $url]);
    }

    #hazır fonksiyon
    /**
     * @Route("/generate-url-servis")
     * @return JsonResponse
     */
    public function urlUret2(UrlGeneratorInterface $router)
    {
        $url=$router->generate("app_routing_showmakale",[
            '_locale' => 'en',
            '_format' => 'html',
            'yil'=>1990,
            'slug'=>'Kaliteli-kod-nasıl-Yazilir'
        ]);
        return new JsonResponse(['url' => $url]);
    }

    /**
     * @Route("/generate-url-ornek")
     * @return JsonResponse
     */
    public function ornek()
    {
        $url=$this->generateUrl("post_listele_yeni",[
            'page' => 19,
            'kategori' => 'saglik',
            'yaş' => 29
        ]);

        $fullurl=$this->generateUrl("post_listele_yeni",[
            'page' => 19,
            'kategori' => 'saglik',
            'yaş' => 29
        ],UrlGeneratorInterface::ABSOLUTE_URL);
        return new JsonResponse(['url' => $url,'Full URL : '. $fullurl]);
    }

}
