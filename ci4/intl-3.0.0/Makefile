srcdir = /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0
builddir = /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0
top_srcdir = /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0
top_builddir = /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0
EGREP = /usr/bin/grep -E
SED = /usr/bin/sed
CONFIGURE_COMMAND = './configure' '--with-php-config=/Applications/XAMPP/xamppfiles/bin/php-config' '--enable-intl' 'PKG_CONFIG_PATH=/Users/taufik/.homebrew/opt/icu4c/lib/pkgconfig:'
CONFIGURE_OPTIONS = '--with-php-config=/Applications/XAMPP/xamppfiles/bin/php-config' '--enable-intl' 'PKG_CONFIG_PATH=/Users/taufik/.homebrew/opt/icu4c/lib/pkgconfig:'
SHLIB_SUFFIX_NAME = dylib
SHLIB_DL_SUFFIX_NAME = so
AWK = awk
INTL_SHARED_LIBADD = -Wl,-rpath,/Users/taufik/.homebrew/opt/icu4c@78/lib -L/Users/taufik/.homebrew/opt/icu4c@78/lib -licuio -licui18n -licuuc
shared_objects_intl = php_intl.lo intl_error.lo intl_convert.lo intl_convertcpp.lo collator/collator.lo collator/collator_class.lo collator/collator_sort.lo collator/collator_convert.lo collator/collator_locale.lo collator/collator_compare.lo collator/collator_attr.lo collator/collator_create.lo collator/collator_is_numeric.lo collator/collator_error.lo common/common_error.lo common/common_enum.lo common/common_date.lo converter/converter.lo formatter/formatter.lo formatter/formatter_main.lo formatter/formatter_class.lo formatter/formatter_attr.lo formatter/formatter_data.lo formatter/formatter_format.lo formatter/formatter_parse.lo normalizer/normalizer.lo normalizer/normalizer_class.lo normalizer/normalizer_normalize.lo locale/locale.lo locale/locale_class.lo locale/locale_methods.lo dateformat/dateformat.lo dateformat/dateformat_class.lo dateformat/dateformat_attr.lo dateformat/dateformat_data.lo dateformat/dateformat_format.lo dateformat/dateformat_format_object.lo dateformat/dateformat_parse.lo dateformat/dateformat_create.lo dateformat/dateformat_attrcpp.lo dateformat/dateformat_helpers.lo msgformat/msgformat.lo msgformat/msgformat_attr.lo msgformat/msgformat_class.lo msgformat/msgformat_data.lo msgformat/msgformat_format.lo msgformat/msgformat_helpers.lo msgformat/msgformat_parse.lo grapheme/grapheme_string.lo grapheme/grapheme_util.lo resourcebundle/resourcebundle.lo resourcebundle/resourcebundle_class.lo resourcebundle/resourcebundle_iterator.lo transliterator/transliterator.lo transliterator/transliterator_class.lo transliterator/transliterator_methods.lo timezone/timezone_class.lo timezone/timezone_methods.lo calendar/calendar_class.lo calendar/calendar_methods.lo calendar/gregoriancalendar_methods.lo breakiterator/breakiterator_class.lo breakiterator/breakiterator_iterators.lo breakiterator/breakiterator_methods.lo breakiterator/rulebasedbreakiterator_methods.lo breakiterator/codepointiterator_internal.lo breakiterator/codepointiterator_methods.lo idn/idn.lo
PHP_PECL_EXTENSION = intl
PHP_MODULES = $(phplibdir)/intl.la
PHP_ZEND_EX =
all_targets = $(PHP_MODULES) $(PHP_ZEND_EX)
install_targets = install-modules install-headers
prefix = /Applications/XAMPP/xamppfiles
exec_prefix = $(prefix)
libdir = ${exec_prefix}/lib
prefix = /Applications/XAMPP/xamppfiles
phplibdir = /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/modules
phpincludedir = /Applications/XAMPP/xamppfiles/include/php
CC = cc -std=gnu23
CFLAGS = -g -O2
CFLAGS_CLEAN = $(CFLAGS) -D_GNU_SOURCE
CPP = cc -std=gnu23 -E
CPPFLAGS = -I/Users/taufik/.homebrew/opt/icu4c/include -DHAVE_CONFIG_H
CXX = g++
CXXFLAGS = -g -O2
CXXFLAGS_CLEAN = $(CXXFLAGS)
EXTENSION_DIR = /Applications/XAMPP/xamppfiles/lib/php/extensions/no-debug-non-zts-20220829
PHP_EXECUTABLE = /Applications/XAMPP/xamppfiles/bin/php
EXTRA_LDFLAGS =
EXTRA_LIBS =
INCLUDES = -I/Applications/XAMPP/xamppfiles/include/php -I/Applications/XAMPP/xamppfiles/include/php/main -I/Applications/XAMPP/xamppfiles/include/php/TSRM -I/Applications/XAMPP/xamppfiles/include/php/Zend -I/Applications/XAMPP/xamppfiles/include/php/ext -I/Applications/XAMPP/xamppfiles/include/php/ext/date/lib -I/Users/taufik/.homebrew/opt/icu4c@78/include
LFLAGS =
LDFLAGS = -L/Users/taufik/.homebrew/opt/icu4c/lib
SHARED_LIBTOOL =
LIBTOOL = $(SHELL) $(top_builddir)/libtool
SHELL = /bin/sh
INSTALL_HEADERS =
BUILD_CC = cc -std=gnu23
mkinstalldirs = $(top_srcdir)/build/shtool mkdir -p
INSTALL = $(top_srcdir)/build/shtool install -c
INSTALL_DATA = $(INSTALL) -m 644

DEFS = -I$(top_builddir)/include -I$(top_builddir)/main -I$(top_srcdir)
COMMON_FLAGS = $(DEFS) $(INCLUDES) $(EXTRA_INCLUDES) $(CPPFLAGS) $(PHP_FRAMEWORKPATH)

all: $(all_targets)
	@echo
	@echo "Build complete."
	@echo "Don't forget to run 'make test'."
	@echo

build-modules: $(PHP_MODULES) $(PHP_ZEND_EX)

build-binaries: $(PHP_BINARIES)

libphp.la: $(PHP_GLOBAL_OBJS) $(PHP_SAPI_OBJS)
	$(LIBTOOL) --mode=link $(CC) $(LIBPHP_CFLAGS) $(CFLAGS) $(EXTRA_CFLAGS) -rpath $(phptempdir) $(EXTRA_LDFLAGS) $(LDFLAGS) $(PHP_RPATHS) $(PHP_GLOBAL_OBJS) $(PHP_SAPI_OBJS) $(EXTRA_LIBS) $(ZEND_EXTRA_LIBS) -o $@
	-@$(LIBTOOL) --silent --mode=install cp $@ $(phptempdir)/$@ >/dev/null 2>&1

libs/libphp.bundle: $(PHP_GLOBAL_OBJS) $(PHP_SAPI_OBJS)
	$(CC) $(MH_BUNDLE_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS) $(LDFLAGS) $(EXTRA_LDFLAGS) $(PHP_GLOBAL_OBJS:.lo=.o) $(PHP_SAPI_OBJS:.lo=.o) $(PHP_FRAMEWORKS) $(EXTRA_LIBS) $(ZEND_EXTRA_LIBS) -o $@ && cp $@ libs/libphp.so

install: $(all_targets) $(install_targets)

install-sapi: $(OVERALL_TARGET)
	@echo "Installing PHP SAPI module:       $(PHP_SAPI)"
	-@$(mkinstalldirs) $(INSTALL_ROOT)$(bindir)
	-@if test ! -r $(phptempdir)/libphp.$(SHLIB_DL_SUFFIX_NAME); then \
		for i in 0.0.0 0.0 0; do \
			if test -r $(phptempdir)/libphp.$(SHLIB_DL_SUFFIX_NAME).$$i; then \
				$(LN_S) $(phptempdir)/libphp.$(SHLIB_DL_SUFFIX_NAME).$$i $(phptempdir)/libphp.$(SHLIB_DL_SUFFIX_NAME); \
				break; \
			fi; \
		done; \
	fi
	@$(INSTALL_IT)

install-binaries: build-binaries $(install_binary_targets)

install-modules: build-modules
	@test -d modules && \
	$(mkinstalldirs) $(INSTALL_ROOT)$(EXTENSION_DIR)
	@echo "Installing shared extensions:     $(INSTALL_ROOT)$(EXTENSION_DIR)/"
	@rm -f modules/*.la >/dev/null 2>&1
	@$(INSTALL) modules/* $(INSTALL_ROOT)$(EXTENSION_DIR)

install-headers:
	-@if test "$(INSTALL_HEADERS)"; then \
		for i in `echo $(INSTALL_HEADERS)`; do \
			i=`$(top_srcdir)/build/shtool path -d $$i`; \
			paths="$$paths $(INSTALL_ROOT)$(phpincludedir)/$$i"; \
		done; \
		$(mkinstalldirs) $$paths && \
		echo "Installing header files:          $(INSTALL_ROOT)$(phpincludedir)/" && \
		for i in `echo $(INSTALL_HEADERS)`; do \
			if test "$(PHP_PECL_EXTENSION)"; then \
				src=`echo $$i | $(SED) -e "s#ext/$(PHP_PECL_EXTENSION)/##g"`; \
			else \
				src=$$i; \
			fi; \
			if test -f "$(top_srcdir)/$$src"; then \
				$(INSTALL_DATA) $(top_srcdir)/$$src $(INSTALL_ROOT)$(phpincludedir)/$$i; \
			elif test -f "$(top_builddir)/$$src"; then \
				$(INSTALL_DATA) $(top_builddir)/$$src $(INSTALL_ROOT)$(phpincludedir)/$$i; \
			else \
				(cd $(top_srcdir)/$$src && $(INSTALL_DATA) *.h $(INSTALL_ROOT)$(phpincludedir)/$$i; \
				cd $(top_builddir)/$$src && $(INSTALL_DATA) *.h $(INSTALL_ROOT)$(phpincludedir)/$$i) 2>/dev/null || true; \
			fi \
		done; \
	fi

PHP_TEST_SETTINGS = -d 'open_basedir=' -d 'output_buffering=0' -d 'memory_limit=-1'
PHP_TEST_SHARED_EXTENSIONS =  ` \
	if test "x$(PHP_MODULES)" != "x"; then \
		for i in $(PHP_MODULES)""; do \
			. $$i; \
			if test "x$$dlname" != "xdl_test.so"; then \
				$(top_srcdir)/build/shtool echo -n -- " -d extension=$$dlname"; \
			fi; \
		done; \
	fi; \
	if test "x$(PHP_ZEND_EX)" != "x"; then \
		for i in $(PHP_ZEND_EX)""; do \
			. $$i; $(top_srcdir)/build/shtool echo -n -- " -d zend_extension=$(top_builddir)/modules/$$dlname"; \
		done; \
	fi`
PHP_DEPRECATED_DIRECTIVES_REGEX = '^(magic_quotes_(gpc|runtime|sybase)?|(zend_)?extension(_debug)?(_ts)?)[\t\ ]*='

test: all
	@if test ! -z "$(PHP_EXECUTABLE)" && test -x "$(PHP_EXECUTABLE)"; then \
		INI_FILE=`$(PHP_EXECUTABLE) -d 'display_errors=stderr' -r 'echo php_ini_loaded_file();' 2> /dev/null`; \
		if test "$$INI_FILE"; then \
			$(EGREP) -h -v $(PHP_DEPRECATED_DIRECTIVES_REGEX) "$$INI_FILE" > $(top_builddir)/tmp-php.ini; \
		else \
			echo > $(top_builddir)/tmp-php.ini; \
		fi; \
		INI_SCANNED_PATH=`$(PHP_EXECUTABLE) -d 'display_errors=stderr' -r '$$a = explode(",\n", trim(php_ini_scanned_files())); echo $$a[0];' 2> /dev/null`; \
		if test "$$INI_SCANNED_PATH"; then \
			INI_SCANNED_PATH=`$(top_srcdir)/build/shtool path -d $$INI_SCANNED_PATH`; \
			$(EGREP) -h -v $(PHP_DEPRECATED_DIRECTIVES_REGEX) "$$INI_SCANNED_PATH"/*.ini >> $(top_builddir)/tmp-php.ini; \
		fi; \
		TEST_PHP_EXECUTABLE=$(PHP_EXECUTABLE) \
		TEST_PHP_SRCDIR=$(top_srcdir) \
		CC="$(CC)" \
			$(PHP_EXECUTABLE) -n -c $(top_builddir)/tmp-php.ini $(PHP_TEST_SETTINGS) $(top_srcdir)/run-tests.php -n -c $(top_builddir)/tmp-php.ini -d extension_dir=$(top_builddir)/modules/ $(PHP_TEST_SHARED_EXTENSIONS) $(TESTS); \
		TEST_RESULT_EXIT_CODE=$$?; \
		rm $(top_builddir)/tmp-php.ini; \
		exit $$TEST_RESULT_EXIT_CODE; \
	else \
		echo "ERROR: Cannot run tests without CLI sapi."; \
	fi

clean:
	find . -name \*.gcno -o -name \*.gcda | xargs rm -f
	find . -name \*.lo -o -name \*.o -o -name \*.dep | xargs rm -f
	find . -name \*.la -o -name \*.a | xargs rm -f
	find . -name \*.so | xargs rm -f
	find . -name .libs -a -type d|xargs rm -rf
	rm -f libphp.la $(SAPI_CLI_PATH) $(SAPI_CGI_PATH) $(SAPI_LITESPEED_PATH) $(SAPI_FPM_PATH) $(OVERALL_TARGET) modules/* libs/*
	rm -f ext/opcache/jit/zend_jit_x86.c
	rm -f ext/opcache/jit/zend_jit_arm64.c
	rm -f ext/opcache/minilua

distclean: clean
	rm -f Makefile config.cache config.log config.status Makefile.objects Makefile.fragments libtool main/php_config.h main/internal_functions_cli.c main/internal_functions.c Zend/zend_dtrace_gen.h Zend/zend_dtrace_gen.h.bak Zend/zend_config.h
	rm -f main/build-defs.h scripts/phpize
	rm -f ext/date/lib/timelib_config.h ext/mbstring/libmbfl/config.h ext/oci8/oci8_dtrace_gen.h ext/oci8/oci8_dtrace_gen.h.bak
	rm -f scripts/man1/phpize.1 scripts/php-config scripts/man1/php-config.1 sapi/cli/php.1 sapi/cgi/php-cgi.1 sapi/phpdbg/phpdbg.1 ext/phar/phar.1 ext/phar/phar.phar.1
	rm -f sapi/fpm/php-fpm.conf sapi/fpm/init.d.php-fpm sapi/fpm/php-fpm.service sapi/fpm/php-fpm.8 sapi/fpm/status.html
	rm -f ext/phar/phar.phar ext/phar/phar.php
	if test "$(srcdir)" != "$(builddir)"; then \
	  rm -f ext/phar/phar/phar.inc; \
	fi
	$(EGREP) define'.*include/php' $(top_srcdir)/configure | $(SED) 's/.*>//'|xargs rm -f

prof-gen:
	CCACHE_DISABLE=1 $(MAKE) PROF_FLAGS=-fprofile-generate all
	find . -name \*.gcda | xargs rm -f

prof-clean:
	find . -name \*.lo -o -name \*.o | xargs rm -f
	find . -name \*.la -o -name \*.a | xargs rm -f
	find . -name \*.so | xargs rm -f
	rm -f libphp.la $(SAPI_CLI_PATH) $(SAPI_CGI_PATH) $(SAPI_LITESPEED_PATH) $(SAPI_FPM_PATH) $(OVERALL_TARGET) modules/* libs/*

prof-use:
	CCACHE_DISABLE=1 $(MAKE) PROF_FLAGS=-fprofile-use all

%_arginfo.h: %.stub.php
	@if test -e "$(top_srcdir)/build/gen_stub.php"; then \
		if test ! -z "$(PHP)"; then \
			echo Parse $< to generate $@;\
			$(PHP) $(top_srcdir)/build/gen_stub.php $<; \
		elif test ! -z "$(PHP_EXECUTABLE)" && test -x "$(PHP_EXECUTABLE)"; then \
			echo Parse $< to generate $@;\
			$(PHP_EXECUTABLE) $(top_srcdir)/build/gen_stub.php $<; \
		fi; \
	fi;

.PHONY: all clean install distclean test prof-gen prof-clean prof-use
.NOEXPORT:
-include php_intl.dep
php_intl.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/php_intl.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/php_intl.c -o php_intl.lo  -MMD -MF php_intl.dep -MT php_intl.lo
-include intl_error.dep
intl_error.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/intl_error.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/intl_error.c -o intl_error.lo  -MMD -MF intl_error.dep -MT intl_error.lo
-include intl_convert.dep
intl_convert.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/intl_convert.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/intl_convert.c -o intl_convert.lo  -MMD -MF intl_convert.dep -MT intl_convert.lo
-include intl_convertcpp.dep
intl_convertcpp.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/intl_convertcpp.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/intl_convertcpp.cpp -o intl_convertcpp.lo  -MMD -MF intl_convertcpp.dep -MT intl_convertcpp.lo
-include collator/collator.dep
collator/collator.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator.c -o collator/collator.lo  -MMD -MF collator/collator.dep -MT collator/collator.lo
-include collator/collator_class.dep
collator/collator_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_class.c -o collator/collator_class.lo  -MMD -MF collator/collator_class.dep -MT collator/collator_class.lo
-include collator/collator_sort.dep
collator/collator_sort.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_sort.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_sort.c -o collator/collator_sort.lo  -MMD -MF collator/collator_sort.dep -MT collator/collator_sort.lo
-include collator/collator_convert.dep
collator/collator_convert.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_convert.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_convert.c -o collator/collator_convert.lo  -MMD -MF collator/collator_convert.dep -MT collator/collator_convert.lo
-include collator/collator_locale.dep
collator/collator_locale.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_locale.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_locale.c -o collator/collator_locale.lo  -MMD -MF collator/collator_locale.dep -MT collator/collator_locale.lo
-include collator/collator_compare.dep
collator/collator_compare.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_compare.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_compare.c -o collator/collator_compare.lo  -MMD -MF collator/collator_compare.dep -MT collator/collator_compare.lo
-include collator/collator_attr.dep
collator/collator_attr.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_attr.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_attr.c -o collator/collator_attr.lo  -MMD -MF collator/collator_attr.dep -MT collator/collator_attr.lo
-include collator/collator_create.dep
collator/collator_create.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_create.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_create.c -o collator/collator_create.lo  -MMD -MF collator/collator_create.dep -MT collator/collator_create.lo
-include collator/collator_is_numeric.dep
collator/collator_is_numeric.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_is_numeric.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_is_numeric.c -o collator/collator_is_numeric.lo  -MMD -MF collator/collator_is_numeric.dep -MT collator/collator_is_numeric.lo
-include collator/collator_error.dep
collator/collator_error.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_error.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/collator/collator_error.c -o collator/collator_error.lo  -MMD -MF collator/collator_error.dep -MT collator/collator_error.lo
-include common/common_error.dep
common/common_error.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/common/common_error.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/common/common_error.c -o common/common_error.lo  -MMD -MF common/common_error.dep -MT common/common_error.lo
-include common/common_enum.dep
common/common_enum.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/common/common_enum.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/common/common_enum.cpp -o common/common_enum.lo  -MMD -MF common/common_enum.dep -MT common/common_enum.lo
-include common/common_date.dep
common/common_date.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/common/common_date.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/common/common_date.cpp -o common/common_date.lo  -MMD -MF common/common_date.dep -MT common/common_date.lo
-include converter/converter.dep
converter/converter.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/converter/converter.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/converter/converter.c -o converter/converter.lo  -MMD -MF converter/converter.dep -MT converter/converter.lo
-include formatter/formatter.dep
formatter/formatter.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter.c -o formatter/formatter.lo  -MMD -MF formatter/formatter.dep -MT formatter/formatter.lo
-include formatter/formatter_main.dep
formatter/formatter_main.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_main.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_main.c -o formatter/formatter_main.lo  -MMD -MF formatter/formatter_main.dep -MT formatter/formatter_main.lo
-include formatter/formatter_class.dep
formatter/formatter_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_class.c -o formatter/formatter_class.lo  -MMD -MF formatter/formatter_class.dep -MT formatter/formatter_class.lo
-include formatter/formatter_attr.dep
formatter/formatter_attr.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_attr.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_attr.c -o formatter/formatter_attr.lo  -MMD -MF formatter/formatter_attr.dep -MT formatter/formatter_attr.lo
-include formatter/formatter_data.dep
formatter/formatter_data.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_data.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_data.c -o formatter/formatter_data.lo  -MMD -MF formatter/formatter_data.dep -MT formatter/formatter_data.lo
-include formatter/formatter_format.dep
formatter/formatter_format.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_format.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_format.c -o formatter/formatter_format.lo  -MMD -MF formatter/formatter_format.dep -MT formatter/formatter_format.lo
-include formatter/formatter_parse.dep
formatter/formatter_parse.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_parse.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/formatter/formatter_parse.c -o formatter/formatter_parse.lo  -MMD -MF formatter/formatter_parse.dep -MT formatter/formatter_parse.lo
-include normalizer/normalizer.dep
normalizer/normalizer.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/normalizer/normalizer.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/normalizer/normalizer.c -o normalizer/normalizer.lo  -MMD -MF normalizer/normalizer.dep -MT normalizer/normalizer.lo
-include normalizer/normalizer_class.dep
normalizer/normalizer_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/normalizer/normalizer_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/normalizer/normalizer_class.c -o normalizer/normalizer_class.lo  -MMD -MF normalizer/normalizer_class.dep -MT normalizer/normalizer_class.lo
-include normalizer/normalizer_normalize.dep
normalizer/normalizer_normalize.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/normalizer/normalizer_normalize.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/normalizer/normalizer_normalize.c -o normalizer/normalizer_normalize.lo  -MMD -MF normalizer/normalizer_normalize.dep -MT normalizer/normalizer_normalize.lo
-include locale/locale.dep
locale/locale.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/locale/locale.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/locale/locale.c -o locale/locale.lo  -MMD -MF locale/locale.dep -MT locale/locale.lo
-include locale/locale_class.dep
locale/locale_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/locale/locale_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/locale/locale_class.c -o locale/locale_class.lo  -MMD -MF locale/locale_class.dep -MT locale/locale_class.lo
-include locale/locale_methods.dep
locale/locale_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/locale/locale_methods.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/locale/locale_methods.c -o locale/locale_methods.lo  -MMD -MF locale/locale_methods.dep -MT locale/locale_methods.lo
-include dateformat/dateformat.dep
dateformat/dateformat.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat.c -o dateformat/dateformat.lo  -MMD -MF dateformat/dateformat.dep -MT dateformat/dateformat.lo
-include dateformat/dateformat_class.dep
dateformat/dateformat_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_class.c -o dateformat/dateformat_class.lo  -MMD -MF dateformat/dateformat_class.dep -MT dateformat/dateformat_class.lo
-include dateformat/dateformat_attr.dep
dateformat/dateformat_attr.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_attr.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_attr.c -o dateformat/dateformat_attr.lo  -MMD -MF dateformat/dateformat_attr.dep -MT dateformat/dateformat_attr.lo
-include dateformat/dateformat_data.dep
dateformat/dateformat_data.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_data.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_data.c -o dateformat/dateformat_data.lo  -MMD -MF dateformat/dateformat_data.dep -MT dateformat/dateformat_data.lo
-include dateformat/dateformat_format.dep
dateformat/dateformat_format.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_format.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_format.c -o dateformat/dateformat_format.lo  -MMD -MF dateformat/dateformat_format.dep -MT dateformat/dateformat_format.lo
-include dateformat/dateformat_format_object.dep
dateformat/dateformat_format_object.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_format_object.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_format_object.cpp -o dateformat/dateformat_format_object.lo  -MMD -MF dateformat/dateformat_format_object.dep -MT dateformat/dateformat_format_object.lo
-include dateformat/dateformat_parse.dep
dateformat/dateformat_parse.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_parse.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_parse.c -o dateformat/dateformat_parse.lo  -MMD -MF dateformat/dateformat_parse.dep -MT dateformat/dateformat_parse.lo
-include dateformat/dateformat_create.dep
dateformat/dateformat_create.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_create.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_create.cpp -o dateformat/dateformat_create.lo  -MMD -MF dateformat/dateformat_create.dep -MT dateformat/dateformat_create.lo
-include dateformat/dateformat_attrcpp.dep
dateformat/dateformat_attrcpp.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_attrcpp.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_attrcpp.cpp -o dateformat/dateformat_attrcpp.lo  -MMD -MF dateformat/dateformat_attrcpp.dep -MT dateformat/dateformat_attrcpp.lo
-include dateformat/dateformat_helpers.dep
dateformat/dateformat_helpers.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_helpers.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/dateformat/dateformat_helpers.cpp -o dateformat/dateformat_helpers.lo  -MMD -MF dateformat/dateformat_helpers.dep -MT dateformat/dateformat_helpers.lo
-include msgformat/msgformat.dep
msgformat/msgformat.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat.c -o msgformat/msgformat.lo  -MMD -MF msgformat/msgformat.dep -MT msgformat/msgformat.lo
-include msgformat/msgformat_attr.dep
msgformat/msgformat_attr.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_attr.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_attr.c -o msgformat/msgformat_attr.lo  -MMD -MF msgformat/msgformat_attr.dep -MT msgformat/msgformat_attr.lo
-include msgformat/msgformat_class.dep
msgformat/msgformat_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_class.c -o msgformat/msgformat_class.lo  -MMD -MF msgformat/msgformat_class.dep -MT msgformat/msgformat_class.lo
-include msgformat/msgformat_data.dep
msgformat/msgformat_data.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_data.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_data.c -o msgformat/msgformat_data.lo  -MMD -MF msgformat/msgformat_data.dep -MT msgformat/msgformat_data.lo
-include msgformat/msgformat_format.dep
msgformat/msgformat_format.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_format.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_format.c -o msgformat/msgformat_format.lo  -MMD -MF msgformat/msgformat_format.dep -MT msgformat/msgformat_format.lo
-include msgformat/msgformat_helpers.dep
msgformat/msgformat_helpers.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_helpers.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_helpers.cpp -o msgformat/msgformat_helpers.lo  -MMD -MF msgformat/msgformat_helpers.dep -MT msgformat/msgformat_helpers.lo
-include msgformat/msgformat_parse.dep
msgformat/msgformat_parse.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_parse.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/msgformat/msgformat_parse.c -o msgformat/msgformat_parse.lo  -MMD -MF msgformat/msgformat_parse.dep -MT msgformat/msgformat_parse.lo
-include grapheme/grapheme_string.dep
grapheme/grapheme_string.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/grapheme/grapheme_string.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/grapheme/grapheme_string.c -o grapheme/grapheme_string.lo  -MMD -MF grapheme/grapheme_string.dep -MT grapheme/grapheme_string.lo
-include grapheme/grapheme_util.dep
grapheme/grapheme_util.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/grapheme/grapheme_util.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/grapheme/grapheme_util.c -o grapheme/grapheme_util.lo  -MMD -MF grapheme/grapheme_util.dep -MT grapheme/grapheme_util.lo
-include resourcebundle/resourcebundle.dep
resourcebundle/resourcebundle.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/resourcebundle/resourcebundle.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/resourcebundle/resourcebundle.c -o resourcebundle/resourcebundle.lo  -MMD -MF resourcebundle/resourcebundle.dep -MT resourcebundle/resourcebundle.lo
-include resourcebundle/resourcebundle_class.dep
resourcebundle/resourcebundle_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/resourcebundle/resourcebundle_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/resourcebundle/resourcebundle_class.c -o resourcebundle/resourcebundle_class.lo  -MMD -MF resourcebundle/resourcebundle_class.dep -MT resourcebundle/resourcebundle_class.lo
-include resourcebundle/resourcebundle_iterator.dep
resourcebundle/resourcebundle_iterator.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/resourcebundle/resourcebundle_iterator.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/resourcebundle/resourcebundle_iterator.c -o resourcebundle/resourcebundle_iterator.lo  -MMD -MF resourcebundle/resourcebundle_iterator.dep -MT resourcebundle/resourcebundle_iterator.lo
-include transliterator/transliterator.dep
transliterator/transliterator.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/transliterator/transliterator.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/transliterator/transliterator.c -o transliterator/transliterator.lo  -MMD -MF transliterator/transliterator.dep -MT transliterator/transliterator.lo
-include transliterator/transliterator_class.dep
transliterator/transliterator_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/transliterator/transliterator_class.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/transliterator/transliterator_class.c -o transliterator/transliterator_class.lo  -MMD -MF transliterator/transliterator_class.dep -MT transliterator/transliterator_class.lo
-include transliterator/transliterator_methods.dep
transliterator/transliterator_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/transliterator/transliterator_methods.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/transliterator/transliterator_methods.c -o transliterator/transliterator_methods.lo  -MMD -MF transliterator/transliterator_methods.dep -MT transliterator/transliterator_methods.lo
-include timezone/timezone_class.dep
timezone/timezone_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/timezone/timezone_class.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/timezone/timezone_class.cpp -o timezone/timezone_class.lo  -MMD -MF timezone/timezone_class.dep -MT timezone/timezone_class.lo
-include timezone/timezone_methods.dep
timezone/timezone_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/timezone/timezone_methods.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/timezone/timezone_methods.cpp -o timezone/timezone_methods.lo  -MMD -MF timezone/timezone_methods.dep -MT timezone/timezone_methods.lo
-include calendar/calendar_class.dep
calendar/calendar_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/calendar/calendar_class.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/calendar/calendar_class.cpp -o calendar/calendar_class.lo  -MMD -MF calendar/calendar_class.dep -MT calendar/calendar_class.lo
-include calendar/calendar_methods.dep
calendar/calendar_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/calendar/calendar_methods.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/calendar/calendar_methods.cpp -o calendar/calendar_methods.lo  -MMD -MF calendar/calendar_methods.dep -MT calendar/calendar_methods.lo
-include calendar/gregoriancalendar_methods.dep
calendar/gregoriancalendar_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/calendar/gregoriancalendar_methods.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/calendar/gregoriancalendar_methods.cpp -o calendar/gregoriancalendar_methods.lo  -MMD -MF calendar/gregoriancalendar_methods.dep -MT calendar/gregoriancalendar_methods.lo
-include breakiterator/breakiterator_class.dep
breakiterator/breakiterator_class.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/breakiterator_class.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/breakiterator_class.cpp -o breakiterator/breakiterator_class.lo  -MMD -MF breakiterator/breakiterator_class.dep -MT breakiterator/breakiterator_class.lo
-include breakiterator/breakiterator_iterators.dep
breakiterator/breakiterator_iterators.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/breakiterator_iterators.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/breakiterator_iterators.cpp -o breakiterator/breakiterator_iterators.lo  -MMD -MF breakiterator/breakiterator_iterators.dep -MT breakiterator/breakiterator_iterators.lo
-include breakiterator/breakiterator_methods.dep
breakiterator/breakiterator_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/breakiterator_methods.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/breakiterator_methods.cpp -o breakiterator/breakiterator_methods.lo  -MMD -MF breakiterator/breakiterator_methods.dep -MT breakiterator/breakiterator_methods.lo
-include breakiterator/rulebasedbreakiterator_methods.dep
breakiterator/rulebasedbreakiterator_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/rulebasedbreakiterator_methods.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/rulebasedbreakiterator_methods.cpp -o breakiterator/rulebasedbreakiterator_methods.lo  -MMD -MF breakiterator/rulebasedbreakiterator_methods.dep -MT breakiterator/rulebasedbreakiterator_methods.lo
-include breakiterator/codepointiterator_internal.dep
breakiterator/codepointiterator_internal.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/codepointiterator_internal.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/codepointiterator_internal.cpp -o breakiterator/codepointiterator_internal.lo  -MMD -MF breakiterator/codepointiterator_internal.dep -MT breakiterator/codepointiterator_internal.lo
-include breakiterator/codepointiterator_methods.dep
breakiterator/codepointiterator_methods.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/codepointiterator_methods.cpp
	$(LIBTOOL) --mode=compile $(CXX) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CXXFLAGS_CLEAN) $(EXTRA_CXXFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/breakiterator/codepointiterator_methods.cpp -o breakiterator/codepointiterator_methods.lo  -MMD -MF breakiterator/codepointiterator_methods.dep -MT breakiterator/codepointiterator_methods.lo
-include idn/idn.dep
idn/idn.lo: /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/idn/idn.c
	$(LIBTOOL) --mode=compile $(CC) -I. -I/Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0 $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS)   -Wno-write-strings -DZEND_COMPILE_DL_EXT=1 -c /Applications/XAMPP/xamppfiles/htdocs/jubelio-d365fo-middleware/ci4/intl-3.0.0/idn/idn.c -o idn/idn.lo  -MMD -MF idn/idn.dep -MT idn/idn.lo
$(phplibdir)/intl.la: ./intl.la
	$(LIBTOOL) --mode=install cp ./intl.la $(phplibdir)

./intl.la: $(shared_objects_intl) $(INTL_SHARED_DEPENDENCIES)
	$(LIBTOOL) --mode=link $(CC) -shared $(COMMON_FLAGS) $(CFLAGS_CLEAN) $(EXTRA_CFLAGS) $(LDFLAGS)  -o $@ -export-dynamic -avoid-version -prefer-pic -module -rpath $(phplibdir) $(EXTRA_LDFLAGS) $(shared_objects_intl) $(INTL_SHARED_LIBADD)

