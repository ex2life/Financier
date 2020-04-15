<div class="col-12">
    <div class="mb-2">
        <a href="{{ route((is_null($socialIdent->vkontakte)) ? 'auth_social' : 'auth_social_del', ['provider' => 'vkontakte']) }}">
            <button type="button" class="social-button vk-button">
                                                            <span class="social-button__icon vk-icon">
                                                                <object
                                                                    type="image/svg+xml"
                                                                    data="{{asset("images/social/VKLogo.svg")}}">
                                                                </object>
                                                            </span>
                <span
                    class="social-button__text vk-text">{{ (is_null($socialIdent->vkontakte)) ? __('Add sign in with') : __('Delete sign in with') }} VK</span>
            </button>
        </a>
    </div>
    <div class="mb-2">
        <a href="{{route((is_null($socialIdent->google)) ? 'auth_social' : 'auth_social_del', ['provider' => 'google']) }}">
            <button type="button" class="social-button google-button">
                                            <span class="social-button__icon google-icon">
                                                <object
                                                    type="image/svg+xml"
                                                    data="{{asset("images/social/GoogleLogo.svg")}}">
                                                </object>
                                            </span>
                <span class="social-button__text google-text">{{(is_null($socialIdent->google)) ? __('Add sign in with') : __('Delete sign in with') }} Google</span>
            </button>
        </a>
    </div>
    <div class="mb-2">
        <a href="{{route((is_null($socialIdent->twitter)) ? 'auth_social' : 'auth_social_del', ['provider' => 'twitter']) }}">
            <button type="button" class="social-button twitter-button">
                                            <span class="social-button__icon twitter-icon">
                                                <object
                                                    type="image/svg+xml"
                                                    data="{{asset("images/social/TwitterLogo.svg")}}">
                                                </object>
                                            </span>
                <span
                    class="social-button__text twitter-text">{{(is_null($socialIdent->twitter)) ? __('Add sign in with') : __('Delete sign in with') }} Twitter</span>
            </button>
        </a>
    </div>
    <div class="form-group">
        <a href="{{route((is_null($socialIdent->facebook)) ? 'auth_social' : 'auth_social_del', ['provider' => 'facebook']) }}">
            <button type="button" class="social-button facebook-button">
                                            <span class="social-button__icon facebook-icon">
                                                <img src="{{asset("images/social/FacebookLogo.png")}}" alt=""
                                                     height="100%" width="100%">
                                            </span>
                <span
                    class="social-button__text facebook-text">{{(is_null($socialIdent->facebook)) ? __('Add sign in with') : __('Delete sign in with') }} Facebook</span>
            </button>
        </a>
    </div>
</div>
