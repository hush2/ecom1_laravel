@layout('base')

@section('page_title')
    About
@endsection

@section('content')

    <h3>About</h3>
    <br />
    
    <p><em>Knowledge is Power</em> is the first example from the book {{ HTML::link('http://www.larryullman.com/books/effortless-e-commerce-with-php-and-mysql/', 'Effortless E-Commerce with PHP and MySQL') }}</a> by Larry Ullman</p>
    <p>Original code by Larry Ullman. Laravel 3.x version by hush2.</p>

    <h4>Credits</h4>
    <p>Common Attack tips from {{ HTML::link('http://www.cmswire.com/cms/web-cms/how-they-hack-your-website-overview-of-common-techniques-002339.php', 'CMSWire') }}</p>
    <p>Database Security tips from {{ HTML::link('https://securosis.com/blog/database-security-fundamentals-access-authorization/', 'Securosis') }}</p>
    <p>General Web Security tips from {{ HTML::link('http://web.appstorm.net/roundups/self-publishing/15-great-ways-to-secure-your-website/', 'Web.AppStorm') }}</p>
    <p>PHP Security tips from {{ HTML::link('http://www.ultramegatech.com/2009/08/5-basic-php-security-tips/', 'UltraMega') }}</p>

@endsection
